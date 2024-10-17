<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\EventsCategoryRequest;
use App\Models\Event;
use App\Models\EventsCategory;
use App\Services\EventsCategoryService;
use Illuminate\Http\Request;

class EventsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $eventsCategoryService;
    public function __construct()
    {
        $this->eventsCategoryService = new EventsCategoryService;
        
    }
    public function index(Request $request)
    {
        $eventsCategories = $this->eventsCategoryService->collection($request->all());
       
        if(isset($eventsCategories['errors'])){
            return response()->json($eventsCategories['errors'],400);
        }
        return view('pages.events')->with('eventsCategories', $eventsCategories);
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
    public function store(EventsCategoryRequest $request)
    {
        $eventsCategory = $this->eventsCategoryService->store($request->validated());
     
        if(isset($eventsCategory['errors'])){
            return response()->json($eventsCategory['errors'],400);
        }
        return response()->json($eventsCategory['data'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        
        $eventsCategory = $this->eventsCategoryService->resource($id);
     
        if(isset($eventsCategory['errors'])){
            return response()->json($eventsCategory['errors'],400);
        }
        // return response()->json($eventsCategory['data'],200);
    
        $eventsCategory = EventsCategory::findOrFail($id);

        // Fetch events associated with this category
        $events = Event::where('events_categories_id',$id)->get();


        // Pass both the category and events to the view
        return view('pages/event_details', compact('eventsCategory', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
