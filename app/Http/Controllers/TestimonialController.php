<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\TestimonialRequest;
use App\Models\Testimonial;
use App\Services\homeTestimonialService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    protected $homeTestimonialService;
    public function __construct(homeTestimonialService $homeTestimonialService){
        $this->homeTestimonialService = $homeTestimonialService;
    }
   
    public function index(Request $request)
    {
        $testimonials = $this->homeTestimonialService->collection($request->all());
        if (isset($testimonials['errors'])) {
            return response()->json($testimonials['errors'], 400);
        }
        return response()->json($testimonials,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        $data = $this->homeTestimonialService->store($request->validated());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id,TestimonialRequest $request)
    {
        $data = $this->homeTestimonialService->resource($id,$request->all());
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data, 200);
    }
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
       
        return response()->json($testimonial,200);
    }
    public function editView($id)
    {
        $testimonial = Testimonial::findOrFail($id);  // Find the facility by ID
        return view('sme_Cpanel.pages.edit_testimonial', compact('testimonial'));  // Pass the data to the view
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, TestimonialRequest $request)
    {
      
        $data = $this->homeTestimonialService->update($id, $request->validated());
        
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
       
       return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->homeTestimonialService->delete($id);
        if (isset($data['errors'])) {
            return response()->json($data['errors'], 400);
        }
        return response()->json($data,200);
    }
}
