<?php

namespace App\Http\Controllers;

use App\DataTables\ResultsDataTable;
use App\Http\Requests\Result\StoreResultRequest;
use App\Models\Event;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ResultsDataTable $dataTable)
    {
        $result = Result::with('subEvent.event')->find(2);
        // return $result;
        return $dataTable->render('results.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::with('subEvents')->get();

        return view('results.create')->with([
            'events' => $events
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultRequest $request)
    {
        $fields = $request->all();

        $file = $request->hasFile('file');

        if ($file) {
            $file = $request->file('file');
            $name = $file->store('results', 'public');
            $fields['file'] = $name;
        }

        Result::create($fields);

        return redirect()->route('results.index')->with('success', 'Successfully published the result.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        $result->delete();
        return redirect()->back()->with('success', 'Result is deleted successfully.');
    }

    /**
     * Download the specified resource from storage.
     */
    public function download(Result $result)
    {
        // Define the disk where the file is stored (e.g., 'public', 'local')
        $disk = 'public';
        $file = $result->file;

        // Check if the file exists in the specified disk
        if (Storage::disk($disk)->exists($file)) {
            // Get the file's MIME type
            $mimeType = Storage::disk($disk)->mimeType($file);

            // Return the file as a downloadable response
            return Storage::disk($disk)->download($file, $result->title, ['Content-Type' => $mimeType]);
        } else {
            // Handle the case where the file does not exist (e.g., show an error message)
            return redirect()->back()->with('error', '404 Result not found.');
        }

    }
}