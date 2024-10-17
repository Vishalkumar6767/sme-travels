<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\EventsCategoryRequest;
use App\Http\Requests\Events\EventsRequest;
use App\Models\Event;
use App\Services\EventsCategoryService;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $eventService;
    public function __construct()
    {
        $this->eventService = new EventService;
        
        
    }
    public function index($id)
    {
        
      
        $eventsCategory = Event::find($id);
    
        // Check if category exists
        if (!$eventsCategory) {
            return redirect()->back()->with('error', 'Event category not found.');
        }
    
        // Fetch events for this category (optional, depending on your logic)
        $events = Event::where('events_categories_id', $id)->get();
    
        // Pass the category and events to the view
        return view('.sme_Cpanel.pages.event_details', [
            'eventsCategory' => $eventsCategory,
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventsRequest $request)
    {
        $events = $this->eventService->store($request->validated());
        
        if(isset($events['errors'])){
            return response()->json($events['errors'],400);
        }
        return view('/sme_Cpanel/pages/event_details')->with('events', $events);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->eventService->resource($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id,EventsRequest $request)
    {
        $data = $this->eventService->update($id,$request);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->eventService->delete($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }
}
