<?php

namespace App\Http\Controllers;

use App\Http\Requests\About\FounderRequest;
use App\Models\Founder;
use App\Services\FounderService;
use Illuminate\Http\Request;

class FounderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $founderService;
    public function __construct(FounderService $founderService){
        $this->founderService = $founderService;

    }
  
    public function store(FounderRequest $request)
    {
        
       $founder= $this->founderService->store($request->validated());
        if(isset($founder['error'])){
            return response()->json($founder['error'],400);
        }
        return response()->json($founder,200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
       $founder= $this->founderService->resource($id);
        if(isset($data['error'])){
            return response()->json($founder['error'],400);
        }
        return response()->json($founder,200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    { 
       $founder= $this->founderService->resource($id);
       
        if(isset($founder['error'])){
            return response()->json($founder['error'],400);
        }
        return response()->json($founder,200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id,FounderRequest $request)
    {
       
        
       $founder= $this->founderService->update($id,$request->validated());
        if(isset($data['error'])){
            return response()->json($founder['error'],400);
        }
        return response()->json($founder,200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
       
       $founder= $this->founderService->delete($id);
        if(isset($data['error'])){
            return response()->json($founder['error'],400);
        }
        return response()->json( $founder,200);
        
    }
}
