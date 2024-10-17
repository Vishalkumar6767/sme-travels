<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $activityService;
    public function __construct(){
        $this->activityService = new ActivityService;
    }
 

    public function index(Request $request)
    {
        $activities = $this->activityService->collection($request->all());
       
        if(isset($activities['errors'])){
            return response()->json($activities['errors'],400);
        }
        return view('pages.activity')->with('activities', $activities);
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        $contact = $this->activityService->store($request->validated());
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
        return response()->json($contact,200);

    }

    
    public function show(int $id)
    {
        $contact = $this->activityService->resource($id);
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
        return response()->json($contact,200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $activity = Activity::findOrFail($id);
        return view('pages.edit_activity', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, ActivityRequest $request)
    {
        $contact = $this->activityService->update($id,$request);
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
        return response()->json($contact,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $contact = $this->activityService->delete($id);
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
        return response()->json($contact,200);
       
    }
}
