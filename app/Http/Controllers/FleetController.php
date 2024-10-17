<?php

namespace App\Http\Controllers;

use App\Http\Requests\FleetRequest;
use App\Models\Fleet;
use App\Services\FleetService;
use Illuminate\Http\Request;

class FleetController extends Controller
{

  protected $fleetService;  
public function __construct(FleetService $fleetService){
    $this->fleetService = $fleetService;
    
}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->fleetService->collection( $request->all());
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
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
    public function store(FleetRequest $request)
    {
        $data = $this->fleetService->store($request->validated());
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->fleetService->resource($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fleet $fleet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, FleetRequest $request)
    {
        $data = $this->fleetService->update($id, $request->validated());
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $data = $this->fleetService->delete($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
    }
}
