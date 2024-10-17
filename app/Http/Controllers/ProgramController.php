<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Models\Program;
use App\Services\ProgramService;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $programService;
     public function __construct()
     {
       $this->programService = new ProgramService; 
     }
    public function index(Request $request)
    {
        $data = $this->programService->collection($request->all());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);

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
    public function store(ProgramRequest $request)
    {
        $data = $this->programService->store($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);

        }
        return response()->json($data,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $program = Program::findOrFail($id);

    // Return the view and pass the program variable
    return view('pages.program', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, ProgramRequest $request)
    {
       
       
        // Pass the validated request data to the service
        $program = $this->programService->update($id, $request->validated());
       
        if (isset($program['errors'])) {
            return response()->json($program['errors'], 400);
        }
    
        return view('pages.program', compact('program'));
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }
}
