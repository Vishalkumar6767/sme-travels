<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\EmployeeTransportationRequest;
use App\Models\EmployeeTransportation;
use App\Services\EmployeeTransportationService;
use Illuminate\Http\Request;


class EmployeeTransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $employeeTransportationService;
    public function __construct(EmployeeTransportationService $employeeTransportationService){
        $this->employeeTransportationService = $employeeTransportationService;
    }
    
    public function store(EmployeeTransportationRequest $request)
    {
        $data = $this->employeeTransportationService->store($request->validated());
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
        $data = $this->employeeTransportationService->resource($id);
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
        $data = $this->employeeTransportationService->resource($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, EmployeeTransportationRequest $request)
    {
        $data = $this->employeeTransportationService->update($id, $request->validated());
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
        $data = $this->employeeTransportationService->delete($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
        
    }
}
