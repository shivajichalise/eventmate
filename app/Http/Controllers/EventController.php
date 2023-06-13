<?php

namespace App\Http\Controllers;

use App\DataTables\EventsDataTable;
use App\DataTables\SubEventsDataTable;
use App\DataTables\TicketsDataTable;
use App\Http\Requests\EventRequests\SaveGeneralRequest;
use App\Http\Requests\EventRequests\SaveSubEventRequest;
use App\Http\Requests\EventRequests\SaveTicketRequest;
use App\Models\Event;
use App\Models\SubEvent;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->form('general');
    }

    /**
     * Show event create multi step form
     */
    public function form($step)
    {
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
                break;
        }
    }

    /**
     * Save event general details in session.
     */
    public function saveGeneral(SaveGeneralRequest $request)
    {
        $fields = $request->all();

        $sessionData = Session::get('event', []);

        $event = Event::create($fields);

        $sessionData['general'] = $event;
        Session::put('event', $sessionData);

        return redirect()->route('events.form', ['step' => 'sub-events'])->with('info', 'Event\'s general information is saved temporarily. Please complete all the steps to make it permanent.');
    }

    /**
     * Save sub-event details in session.
     */
    public function saveSubEvent(SaveSubEventRequest $request)
    {
        $fields = $request->all();

        $sessionData = Session::get('event', []);
        $sessionData['sub-events'] = $fields;
        Session::put('event', $sessionData);

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

        $sessionData = Session::get('event', []);
        $sessionData['tickets'] = $fields;
        Session::put('event', $sessionData);

        $code = Hashids::encode(time());
        $fields['code'] = $code;

        Ticket::create($fields);
        return redirect()->back()->with('info', 'Ticket is saved temporarily. Please complete all the steps to make it permanent.');
    }

    /**
     * Destroy a sub-event details.
     */
    public function destroyTicket(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket is deleted successfully.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
