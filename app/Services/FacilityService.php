<?php

namespace App\Services;

use App\Models\MainFacility;
use Illuminate\Support\Facades\Storage;

class FacilityService
{
    /**
     * Create a new class instance.
     */
    protected $facilityObject;
    public function __construct()
    {
       $this->facilityObject = new MainFacility();
    }
    public function collection($inputs)
    {
        $data = $this->facilityObject->get();
        return $data;
        
    }
    

    public function store($inputs)
{
    $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
           
       
         $facility = $this->facilityObject->create([
            'name'  => $inputs['name'],
            'image' => $imageName,
            'description' => $inputs['description'],
        ]);
        $data = [
            'status' => true,
                'message' => "Image uploaded successfully",
                'path' => asset('storage/assets/'. $imageName),
                'data' => $facility
            ];
           return $data;
        
    }


    public function resource(int $id)
    {

        // $includes = [];

        // if (!empty($inputs['includes'])) {
        //     $includes = explode(",", $inputs['includes']);
        // }
        $data = $this->facilityObject->findOrFail($id);

        return $data;
    }

    public function update(int $id, $inputs)

    {
        
        $facility = $this->facilityObject->findOrFail($id);
    
        // Check if a new image is uploaded
        if ($inputs['image']) {
            if ($facility->image && Storage::exists('public/assets/' . $facility->image)) {
                Storage::delete('public/assets/' . $facility->image);
            }
    
            $imageName = time() . '.' . $inputs['image']->getClientOriginalExtension();
            $inputs['image']->storeAs('public/assets', $imageName);
        } else {
            $imageName = $facility->image;
        }
        // Update facility data
        $facility->update([
            'name' => $inputs['name'],
            'image' => $imageName,
            'description'=>$inputs['description'],
        ]);
    
        return $facility;
    }
    
    
    public function delete($id)
    {
        // $id = auth()->id();
        $data = $this->facilityObject->findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}
