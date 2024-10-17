<?php

namespace App\Services;

use App\Models\VisionMission;
use Illuminate\Support\Facades\Storage;

class VisionService
{
    /**
     * Create a new class instance.
     */
   protected $visionObject;
    public function __construct()
    {
        $this ->visionObject = new VisionMission();
    }

    public function collection(){
        $data = $this ->visionObject->get()->all();
        return $data;
 
    }
    public function store($inputs){
        $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
        $data = $this->visionObject->create([
            'image'=>$imageName,
            'title' =>$inputs['title'],
            'description' => $inputs['description'],
            
        ]);
        return $data;

    }
    public function resource($id){
        $data = $this->visionObject->findOrFail($id);
        return $data;
    }
    public function update($id, $inputs){
        $data = VisionMission::findOrFail($id);
        if ($inputs['image']) {
            if ($data->image && Storage::exists('public/assets/' . $data->image)) {
                Storage::delete('public/assets/' . $data->image);
            }
    
            $imageName = time() . '.' . $inputs['image']->getClientOriginalExtension();
            $inputs['image']->storeAs('public/assets', $imageName);
        } else {
            $imageName = $data->image;
        }
        $data ->update($inputs);
        return $data;
    }
}
