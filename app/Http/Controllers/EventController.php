<?php

namespace App\Http\Controllers;

use App\DataTables\EventsDataTable;
use App\Http\Requests\EventRequests\SaveGeneralRequest;
use App\Models\Event;
use Illuminate\Http\Request;

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
                $general = null;
                return view('events.listings.general')->with([
                    'step' => 1,
                    'general' => $general
                ]);
                break;
            case 'sub-events':
                break;
            case 'tickets':
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
        Event::create($fields);
        return redirect()->route('events.form', ['step' => 'sub-events'])->with('success', 'Event\'s general information is saved.');
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
