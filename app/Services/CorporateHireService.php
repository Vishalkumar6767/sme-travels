<?php

namespace App\Services;

use App\Models\CorporateHire;
use Illuminate\Support\Facades\Storage;

class CorporateHireService
{
    /**
     * Create a new class instance.
     */
    protected $corporateHireObject;
    public function __construct(CorporateHire $corporateHireObject)
    {
        $this->corporateHireObject = $corporateHireObject;
        
    }

  public function collection($inputs)
    {
        $data = $this->corporateHireObject->get()->all();
        return $data;
        
    }
    

    public function store($inputs)
{
    $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
           
       
         $data= $this->corporateHireObject->create([
            'name'  => $inputs['name'],
            'image' => $imageName,
            'description1' => $inputs['description1'],
            'description2' => $inputs['description2'],
            'description3' => $inputs['description3'],
        ]);
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
        $data = $this->corporateHireObject->findOrFail($id);

        return $data;
    }

    public function update(int $id, $inputs)

    {
        
        $data= $this->corporateHireObject->findOrFail($id);
    
        // Check if a new image is uploaded
        if ($inputs['image']) {
            if ($data->image && Storage::exists('public/assets/' . $data->image)) {
                Storage::delete('public/assets/' . $data->image);
            }
    
            $imageName = time() . '.' . $inputs['image']->getClientOriginalExtension();
            $inputs['image']->storeAs('public/assets', $imageName);
        } else {
            $imageName = $data->image;
        }
        
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
        $data = $this->corporateHireObject->findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}

