<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\CorporateHireRequest;
use App\Models\CorporateHire;
use App\Services\CorporateHireService;
use Illuminate\Http\Request;

class CorporateHireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $corporateHireService;
    public function __construct(CorporateHireService $corporateHireService){
        $this->corporateHireService = $corporateHireService;

    }
    public function index(Request $request)
    {
        $data = $this->corporateHireService->collection($request->all());
        if(isset($data['error'])){
            return response()->json($data['error'], 400);
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
    public function store(CorporateHireRequest $request)
    {
        $data = $this->corporateHireService->store($request->validated());
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
        $data = $this->corporateHireService->resource($id);
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
        $data = $this->corporateHireService->resource($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, CorporateHireRequest $request)
    {
        $data = $this->corporateHireService->update($id, $request->validated());
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
        $data = $this->corporateHireService->delete($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
        
    }
}
