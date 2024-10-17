<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainFacilityRequest;
use App\Models\MainFacility;
use App\Services\FacilityService;
use Illuminate\Http\Request;

class MainFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $facilityService;
    public function __construct(FacilityService $facilityService){
        $this->facilityService = $facilityService;

    }
   
    public function index(Request $request)
    {
        $facilities = $this->facilityService->collection($request->all());
        if (isset($facilities['errors'])) {
            return response()->json($facilities['errors'], 400);
        }
        // $facilities = Facility::all();
        return response()->json($facilities, 200);
        

    // return view('pages.facility', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainFacilityRequest $request)
    {
        $data = $this->facilityService->store($request->validated());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->facilityService->resource($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }
    public function edit($id){
        $facility = MainFacility::findOrFail($id);
       
       return response()->json($facility,200);
    }
    public function editView($id)
{
    $facility = MainFacility::findOrFail($id);  // Find the facility by ID
    return view('sme_Cpanel.pages.edit_facility', compact('facility'));  // Pass the data to the view
}

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, MainFacilityRequest $request)
    {
      
        $data = $this->facilityService->update($id, $request->validated());
        
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
        $data = $this->facilityService->delete($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }
}
