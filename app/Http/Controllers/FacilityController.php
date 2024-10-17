<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\FacilityRequest;
use App\Services\HomeFacilityService;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $homeFacilityService;
    public function __construct(HomeFacilityService $homeFacilityService){
        $this->homeFacilityService = $homeFacilityService;

    }
   
    public function index(Request $request)
    {
        $facilities = $this->homeFacilityService->collection($request->all());
        if (isset($facilities['errors'])) {
            return response()->json($facilities['errors'], 400);
        }
        return response()->json($facilities, 200);
        // $facilities = Facility::all();

    // return view('pages.home_facility', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacilityRequest $request)
    {
        $data = $this->homeFacilityService->store($request->validated());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id,FacilityRequest $request)
    {
        $data = $this->homeFacilityService->resource($id, $request->all());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, FacilityRequest $request)
    {
      
        $data = $this->homeFacilityService->update($id, $request->all());
        
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
        $data = $this->homeFacilityService->delete($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }
}
 