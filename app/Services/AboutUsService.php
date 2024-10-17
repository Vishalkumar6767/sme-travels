<?php

namespace App\Services;

use App\Models\AboutUs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AboutUsService
{
    /**
     * Create a new class instance.
     */
    protected $aboutUsObject;
    public function __construct()
    {
        $this->aboutUsObject = new AboutUs;
        
    }
    public function collection(){
        $data = $this->aboutUsObject->get();
        return $data;
    }
    public function store($inputs){
        $img = $inputs['image'];
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(storage_path('app/public/assets'), $imageName);
       DB::beginTransaction();
        $data = $this->aboutUsObject->create([
            'image'=>$imageName,
            'title' =>$inputs['title'],
            'description1'=>$inputs['description1'],
            'description2'=>$inputs['description2'],
            'description3' =>$inputs['description3'],


        ]);
        DB::commit();
        return $data;
    }
    public function resource($id){
        $data = $this->aboutUsObject->findOrFail($id);
        return $data;
    }
    public function Update($id, $inputs){
        $about = $this->aboutUsObject->findOrFail($id);
        // Check if a new image is uploaded
        if ($inputs['image']) {
            if ($about->image && Storage::exists('public/assets/' . $about->image)) {
                Storage::delete('public/assets/' . $about->image);
            }
    
            $imageName = time() . '.' . $inputs['image']->getClientOriginalExtension();
            $inputs['image']->storeAs('public/assets', $imageName);
        } else {
            $imageName = $about->image;
        }
        $about->update([
            'image'=>$imageName,    
            'title' =>$inputs['title'],
            'description1'=>$inputs['description1'],
            'description2'=>$inputs['description2'],
            'description3'=>$inputs['description3'],
        ]);
        return $about;
    }
}
