<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\WhyRequest;
use App\Services\WhyChooseUsService;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $whyChooseUsService;
    public function __construct(WhyChooseUsService $whyChooseUsService){
        $this->whyChooseUsService  = $whyChooseUsService;

    }
    public function index(Request $request)
    {
        $data = $this->whyChooseUsService->collection($request->all());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhyRequest $request)
    {
        $data = $this->whyChooseUsService->store($request->validated());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
       
        return response()->json($data,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->whyChooseUsService->resource($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
         return response()->json($data, 200);
    }
    public function edit(int $id)
    { 
       $data = $this->whyChooseUsService->resource($id);
       
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
        
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, WhyRequest $request)
    {
        $data = $this->whyChooseUsService->update($id, $request->validated());
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
        $data = $this->whyChooseUsService->delete($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }
}


