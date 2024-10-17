<?php

namespace App\Services;

use App\Http\Requests\Home\FacilityRequest;
use App\Models\Facility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeFacilityService
{
    /**
     * Create a new class instance.
     */
   

    protected $facilityObject;
    public function __construct()
    {
        $this->facilityObject = new Facility();
       
    }

    public function collection($inputs)
    {
        $facility = $this->facilityObject->get();
        return $facility;
        
    }
    

    public function store($inputs)
{
    $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
           
       
        $facility = Facility::create([
            'name'  => $inputs['name'],
            'image' => $imageName,
        ]);
        $facility = [
            'status' => true,
                'message' => "Image uploaded successfully",
                'path' => asset('storage/assets/' . $imageName),
                'data' => $facility
            ];
           return $facility;
        
    }


    public function resource(int $id, $inputs)
    {

        $includes = [];

        if (!empty($inputs['includes'])) {
            $includes = explode(",", $inputs['includes']);
        }
        $facility = $this->facilityObject->findOrFail($id);

        return $facility;
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
        
        $facility->update([
            'name' => $inputs['name'],
            'image' => $imageName,
        ]);
    
        return $facility;
    }
    
    
    public function delete($id)
    {
        // $id = auth()->id();
        $facility = $this->facilityObject->findOrFail($id);
        $facility->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}


