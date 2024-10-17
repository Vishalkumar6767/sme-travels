<?php

namespace App\Services;

use App\Models\Fleet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FleetService
{
    /**
     * Create a new class instance.
     */
    protected $fleetObject;
    public function __construct(Fleet $fleetObject)
    {
       $this->fleetObject = $fleetObject;
    }
    public function collection($inputs)
    {
        $data = $this->fleetObject->get()->all();
        return $data;
        
    }
    

    public function store($inputs)
{
    $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
           
       DB::beginTransaction();
         $data= $this->fleetObject->create([
           
            'image' => $imageName,
            'title' => $inputs['title'],
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
        $data = $this->fleetObject->findOrFail($id);

        return $data;
    }

    public function update(int $id, $inputs)

    {
        
        $data= $this->fleetObject->findOrFail($id);
    
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
          
            'image' => $imageName,
            'title'=>$inputs['title'],
           
        ]);
    
        return response()->json($data, 200);
    }
    
    
    public function delete($id)
    {
        // $id = auth()->id();
        $data = $this->fleetObject->findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}


