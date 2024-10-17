<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactEnquiryRequest;
use App\Http\Requests\ContactRequest;
use App\Services\ContactEnquiryService;
use Illuminate\Http\Request;

class ContactEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $contactEnquiryService;
    public function __construct(ContactEnquiryService $contactEnquiryService)
    {
        $this->contactEnquiryService = $contactEnquiryService;
    }
    public function index()
    {
        $data = $this->contactEnquiryService->collection();
        if(isset($data['errors'])){
            return response()->json($data['errors']);
        }
        return response()->json($data);
       
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
    public function store(ContactEnquiryRequest $request)
    {
        $data = $this->contactEnquiryService->store($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors']);
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->contactEnquiryService->resource($id);
        if(isset($data['errors'])){
            return response()->json($data['errors']);
        }
        return response()->json($data);
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
    public function update( int $id,ContactEnquiryRequest $request)
    {
        $data = $this->contactEnquiryService->update($id,$request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors']);
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $data = $this->contactEnquiryService->delete($id);
        if(isset($data['errors'])){
            return response()->json($data['errors']);
        }
        return response()->json($data);
    }
}
