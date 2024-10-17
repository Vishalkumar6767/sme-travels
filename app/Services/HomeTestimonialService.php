<?php

namespace App\Services;

use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeTestimonialService
{
    /**
     * Create a new class instance.
     */
    protected $testimonialObject;
    public function __construct(Testimonial $testimonialObject)
    {
        $this->testimonialObject = $testimonialObject;
       
    }

    public function collection($inputs)
    {
       
        $data = $this->testimonialObject->get();
        // $data = $data->get();
        return $data;
    }

    public function store($inputs){
        DB::beginTransaction();
        $img = $inputs['image'];
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(storage_path('app/public/assets'), $imageName);
        $data = $this->testimonialObject->create([
        'image'=>$imageName,
        'title'=>$inputs['title'],
    
        ]);
        DB::commit();
        // $success['message'] = "data Added Successfully";
        return $data;

    }
    
    public function resource($id, $inputs)
    {

        // $includes = [];

        // if (!empty($inputs['includes'])) {
        //     $includes = explode(",", $inputs['includes']);
        // }
        $data = $this->testimonialObject->findOrFail($id);

        return $data;
    }

    public function update($id, $inputs)

    {
        // $id = auth()->id();
        $data = $this->testimonialObject->findOrFail($id);
        if ($inputs['image']) {
            if ($data->image && Storage::exists('public/assets/' . $data->image)) {
                Storage::delete('public/assets/' . $data->image);
            }
    
            $imageName = time() . '.' . $inputs['image']->getClientOriginalExtension();
            $inputs['image']->storeAs('public/assets', $imageName);
        } else {
            $imageName = $data->image;
        }
        DB::beginTransaction();
        $data->update([
            'image' =>$imageName,
            'title' =>$inputs['title'],
        ]);
        DB::commit();
        $success['message'] = "Data updated successfully";
        return $success;
    }
    public function delete($id)
    {
        // $id = auth()->id();
        $data = $this->testimonialObject->findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}
