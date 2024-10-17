<?php

namespace App\Http\Controllers;

use App\Http\Requests\About\VisionRequest;
use App\Models\VisionMission;
use App\Services\VisionService;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $visionService;
    public function __construct(VisionService $visionService){
        $this->visionService = $visionService;
    }
    public function index()
    {
        $data = $this->visionService->collection();
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
       
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
    public function store(VisionRequest $request)
    {
        $data = $this->visionService->store($request->validated());
       
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->visionService->resource($id);
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = VisionMission::findOrFail($id);
        return view('pages.vision', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id,VisionRequest $request)
    {
        $data = $this->visionService->update($id,$request->validated());
        
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
