<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\FleetManagementRequest;
use App\Models\FleetManagement;
use App\Services\FleetManagementService;
use Illuminate\Http\Request;

class FleetManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $fleetManagementService;
    public function __construct(FleetManagementService $fleetManagementService) {
        $this->fleetManagementService = $fleetManagementService;
    }
    public function store(FleetManagementRequest $request)
    {
        $data = $this->fleetManagementService->store($request->validated());
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
        $data = $this->fleetManagementService->resource($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = $this->fleetManagementService->resource($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FleetManagementRequest $request)
    {
        $data = $this->fleetManagementService->store($request->validated());
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
        $data = $this->fleetManagementService->delete($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
        
    }
}
