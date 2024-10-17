<?php

namespace App\Services;

use App\Models\FleetManagement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FleetManagementService
{
    /**
     * Create a new class instance.
     */
    protected $fleetManagementObject;
    public function __construct(FleetManagement $fleetManagementObject)
    {
        $this->fleetManagementObject = $fleetManagementObject;
      
    }
    public function collection($inputs)
    {
        $data = $this->fleetManagementObject->get()->all();
        return $data;
        
    }
    

    public function store($inputs)
{
    $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
           
       DB::beginTransaction();
         $data= $this->fleetManagementObject->create([
            'name'  => $inputs['name'],
            'image' => $imageName,
            'description1' => $inputs['description1'],
            'description2' => $inputs['description2'],
            'description3' => $inputs['description3'],
        ]);
        DB::commit();
        $data = [
            'status' => true,
                'message' => "Image uploaded successfully",
                'path' => asset('storage/assets/'. $imageName),
                'data' => $data,
            ];
           return $data;
        
    }


    public function resource(int $id)
    {

        // $includes = [];

        // if (!empty($inputs['includes'])) {
        //     $includes = explode(",", $inputs['includes']);
        // }
        $data = $this->fleetManagementObject->findOrFail($id);

        return $data;
    }

    public function update(int $id, $inputs)

    {
        
        $data= $this->fleetManagementObject->findOrFail($id);
    
        if ($inputs['image']) {
            if ($data->image && Storage::exists('public/assets/' . $data->image)) {
                Storage::delete('public/assets/' . $data->image);
            }
    
            $imageName = time() . '.' . $inputs['image']->getClientOriginalExtension();
            $inputs['image']->storeAs('public/assets', $imageName);
        } else {
            $imageName = $data->image;
        }
        // Update facility data
        $data->update([
            'name' => $inputs['name'],
            'image' => $imageName,
            'description1'=>$inputs['description1'],
            'description2'=>$inputs['description2'],
            'description3'=>$inputs['description3'],
        ]);
    
        return $data;
    }
    
    
    public function delete($id)
    {
        // $id = auth()->id();
        $data = $this->fleetManagementObject->findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}


