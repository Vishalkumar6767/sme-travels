<?php

namespace App\Http\Controllers;

use App\Http\Requests\About\AboutUsRequest;
use App\Models\AboutUs;
use App\Services\AboutUsService;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $aboutUsService;

    public function __construct(AboutUsService $aboutUsService)
    {
        $this->aboutUsService = $aboutUsService;
    }
    public function index(Request $request)
    {

        $about = $this->aboutUsService->collection($request->all());
        if(isset($about['errors']))
        {
            return response()->json($about['errors'],400);

        }
      return response()->json($about,200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutUsRequest $request)
    {
        $about = $this->aboutUsService->store($request->validated());
        if(isset($about['errors'])){
            return response()->json($about['errors'],400);

        }
      return response()->json($about,200);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $about = $this->aboutUsService->resource($id);
        if(isset($about['errors'])){
            return response()->json($about['errors'],400);

        }
        return response()->json($about,200);
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $about = AboutUs::findOrFail($id);
        if(isset($about['errors'])){
            return response()->json($about['errors'],400);

        }
       return response()->json($about,200);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, AboutUsRequest $request)
    {
        $about = $this->aboutUsService->update($id , $request->validated());
        if(isset($about['errors'])){
            return response()->json($about['errors'],400);

        }
        return response()->json($about,200);
    }

    /**
     * Remove the specified resource from storage.
     */
   
}
