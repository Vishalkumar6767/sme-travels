<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolutionRequest;
use App\Models\Solution;
use App\Services\SolutionService;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $solutionService;
    public function __construct(SolutionService $solutionService)
    {
        $this->solutionService = $solutionService;
        
    }
    public function index(Request $request)
    {
        $data = $this->solutionService->collection($request->all());
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolutionRequest $request)
    {
        $data = $this->solutionService->store($request->validated());
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Solution $solution)
    {
        //
    }

    public function editView($id)
    {
        $solution = Solution::findOrFail($id);  // Find the facility by ID
        return view('sme_Cpanel.pages.edit_solution', compact('solution'));  // Pass the data to the view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->solutionService->resource($id);
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, SolutionRequest $request)
    {
        $data = $this->solutionService->update($id,$request->validated());
        if(isset($data['error'])){
            return response()->json($data['error'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solution $solution)
    {
        //
    }
}
