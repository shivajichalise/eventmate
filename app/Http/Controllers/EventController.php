<?php

namespace App\Http\Controllers;

use App\DataTables\AttendeesDataTable;
use App\DataTables\EventsDataTable;
use App\DataTables\SubEventsDataTable;
use App\DataTables\TicketsDataTable;
use App\Http\Requests\EventRequests\SaveGeneralRequest;
use App\Http\Requests\EventRequests\SaveSubEventRequest;
use App\Http\Requests\EventRequests\SaveSupportRequest;
use App\Http\Requests\EventRequests\SaveTicketRequest;
use App\Models\Event;
use App\Models\SubEvent;
use App\Models\Support;
use App\Models\Ticket;
use App\Models\Venue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use PragmaRX\Countries\Package\Countries;
use Vinkla\Hashids\Facades\Hashids;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EventsDataTable $dataTable)
    {
        return $dataTable->render('events.index');
    }

    /**
     * Display a listing of the sub-events resource.
     */
    public function subEvents()
    {
        $dataTable = new SubEventsDataTable();

        return $dataTable->render('events.listings.sub_events', [
            'step' => 2
        ]);
    }

    /**
     * Display a listing of the ticketss resource.
     */
    public function tickets()
    {
        $dataTable = new TicketsDataTable();
        $sub_events = SubEvent::doesntHave('ticket')->get();

        $currencies = (new Countries())->currencies()->sortBy('name');

        return $dataTable->render('events.listings.tickets', [
            'step' => 3,
            'sub_events' => $sub_events,
            'currencies' => $currencies
        ]);
    }

    /**
     * Create event session
     */
    public function createEventSession($key, $data = [], $flag = 'create')
    {
        $event = Session::get('event', []);

        if (isset($event[$key]) && is_array($data)) {
            $event[$key] = array_replace($event[$key], $data);
        } else {
            $event[$key] = $data;
        }

        $event['flag'] = $flag;

        Session::put('event', $event);
    }

    public function removeFromSession($key)
    {
        if (Session::has($key)) {
            Session::forget($key);
        }
    }

    /**
         * Show the form for creating a new resource.
         */
    public function create()
    {
        $isEventInSession = Session::get('event', []);

        if(!empty($isEventInSession) && $isEventInSession['flag'] == 'edit') {
            return redirect()->route('events.edit.form', ['event' => $isEventInSession['general'], 'step' => 'general'])
                ->with([
                    'info' => 'You have unfinished event edit process. Please either complete it or discard it to continue.',
                ]);
        }

        return $this->form('general');
    }

    /**
     * Show event create multi step form
     */
    public function form($step)
    {
        $isEventInSession = Session::get('event') ? true : false;

        if($step != 'general') {
            if(!$isEventInSession) {
                return redirect()->route('events.form', ['step' => 'general'])->with('error', 'You can\'t proceed without saving event\'s general information first');
            }
        }

        switch($step) {
            case 'general':
                $general = Session::get('event.general', null);
                return view('events.listings.general')->with([
                    'step' => 1,
                    'general' => $general
                ]);
                break;
            case 'sub-events':
                return $this->subEvents();
                break;
            case 'tickets':
                return $this->tickets();
                break;
            case 'support':
                $support = Session::get('event.support', null);
                return view('events.listings.support')->with([
                    'step' => 4,
                    'support' => $support
                ]);
                break;
        }
    }

    /**
     * Save event general details in session.
     */
    public function saveGeneral(SaveGeneralRequest $request)
    {
        $fields = $request->all();

        $venueFields = $request->only([
            'address',
            'country',
            'state',
            'city',
            'lat',
            'lng',
        ]);

        $sessionData = Session::get('event', []);

        if(empty($sessionData)) {
            $event = Event::create($fields);
            $venueFields['event_id'] = $event->id;
            Venue::create($venueFields);
        } else {
            $event = Event::find($sessionData['general']->id);
            $event->update($fields);

            $venue = Venue::updateOrCreate(['event_id' => $sessionData['general']->id], $venueFields);
        }

        $this->createEventSession('general', $event);

        return redirect()->route('events.form', ['step' => 'sub-events'])->with('info', 'Event\'s general information is saved temporarily. Please complete all the steps to make it permanent.');
    }

    /**
     * Save sub-event details in session.
     */
    public function saveSubEvent(SaveSubEventRequest $request)
    {
        $fields = $request->all();

        $sessionData = Session::get('event', []);
        $fields['event_id'] = $sessionData['general']->id;

        SubEvent::create($fields);
        return redirect()->back()->with('info', 'Sub-event is saved temporarily. Please complete all the steps to make it permanent.');
    }

    /**
     * Destroy a sub-event details.
     */
    public function destroySubEvent(SubEvent $subEvent)
    {
        $subEvent->delete();
        return redirect()->back()->with('success', 'Sub-event is deleted successfully.');
    }

    /**
     * Save ticket details in session.
     */
    public function saveTicket(SaveTicketRequest $request)
    {
        $fields = $request->all();

        $code = Hashids::encode(time());
        $fields['code'] = $code;

        Ticket::create($fields);
        return redirect()->back()->with('info', 'Ticket is saved temporarily. Please complete all the steps to make it permanent.');
    }

    /**
     * Destroy a ticket.
     */
    public function destroyTicket(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket is deleted successfully.');
    }

    /**
     * Save ticket details in session.
     */
    public function saveSupport(SaveSupportRequest $request)
    {
        $fields = $request->all();

        $sessionData = Session::get('event', []);

        Support::updateOrCreate(['event_id' => $sessionData['general']->id], $fields);

        Session::forget('event');
        return redirect()->route('events.index')->with('success', 'Event is created successfully. Please do check if you have properly created sub-events and tickets for those sub-events.');
    }

    /**
         * Store a newly created resource in storage.
         */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $datatable = (new AttendeesDataTable($event->id));

        $subEvents = $event->subEvents;
        $tickets =  $event->tickets;
        $support =  $event->support;

        $lineChart = ChartController::lineChart($event);
        $barChart = ChartController::barChart($event);

        return $datatable->render('events.view', [
            'general' => $event,
            'sub_events' => $subEvents,
            'tickets' => $tickets,
            'support' => $support,
            'barChart' => $barChart,
            'lineChart' => $lineChart,
        ]);

        return view('events.view')->with([
            'general' => $event,
            'sub_events' => $subEvents,
            'tickets' => $tickets,
            'support' => $support,
            'barChart' => $barChart,
            'lineChart' => $lineChart,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $isEventInSession = Session::get('event', []);

        if(!empty($isEventInSession) && $isEventInSession['flag'] == 'create') {
            return redirect()->route('events.form', ['step' => 'general'])
                ->with('info', 'You have unfinished event creation process. Please either complete it or discard it to continue.');
        }

        $this->createEventSession('general', $event, 'edit');
        $this->createEventSession('support', $event->support, 'edit');

        return $this->editForm($event, 'general');
    }

    /**
     * Show event edit multi step form
     */
    public function editForm(Event $event, $step)
    {
        switch($step) {
            case 'general':
                $general = Session::get('event.general', null);
                return view('events.edit_listings.general')->with([
                    'step' => 1,
                    'general' => $general
                ]);
                break;
            case 'sub-events':
                return $this->editSubEvents();
                break;
            case 'tickets':
                return $this->editTickets();
                break;
            case 'support':
                $general = Session::get('event.general', null);
                $support = Session::get('event.support', null);
                return view('events.edit_listings.support')->with([
                    'step' => 4,
                    'support' => $support,
                    'general' => $general
                ]);
                break;
        }
    }

    /**
     * Display a edit listing of the sub-events resource.
     */
    public function editSubEvents()
    {
        $general = Session::get('event.general', null);
        $dataTable = new SubEventsDataTable();

        return $dataTable->render('events.edit_listings.sub_events', [
            'step' => 2,
            'general' => $general
        ]);
    }

    /**
     * Display a edit listing of the tickets resource.
     */
    public function editTickets()
    {
        $general = Session::get('event.general', null);
        $dataTable = new TicketsDataTable();
        $sub_events = SubEvent::doesntHave('ticket')->get();

        $currencies = (new Countries())->currencies()->sortBy('name');

        return $dataTable->render('events.edit_listings.tickets', [
            'step' => 3,
            'sub_events' => $sub_events,
            'currencies' => $currencies,
            'general' => $general
        ]);
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->eventId;
                $event = Event::find($id);
                $event->status = !$event->status;
                $event->save();
                return response()->json(["code" => 200, 'message' => 'Successfull']);
            } catch (Exception $e) {
                return response()->json(["code" => $e->getCode(), 'message' => 'Failed with exception ' . $e->getMessage()]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the event resource from session.
     */
    public function discard()
    {
        $sessionData = Session::get('event', []);

        $event = Event::find($sessionData['general']->id);
        $event->delete();
        $this->removeFromSession('event');
        return redirect()->route('events.index')->with('success', 'Event discarded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->with('success', 'Event is deleted successfully.');
    }

    // Event methods for user
    public function view(SubEvent $subevent)
    {
        $event = $subevent->event;
        $venue = $event->venue;
        $ticket = $subevent->ticket;
        $support = $event->support;

        return Inertia::render('Event/View', [
            'event' => $event,
            'sub_event' => $subevent,
            'venue' => $venue,
            'ticket' => $ticket,
            'support' => $support,
            'hasPaid' => (Auth::check() ? Auth::user()->hasPaidForTicket($ticket) : false)
        ]);
    }
}
