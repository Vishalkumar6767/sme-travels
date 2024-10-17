<?php

namespace App\Services;

use App\Models\Founder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FounderService
{
    /**
     * Create a new class instance.
     */
    protected $founderObject;
    public function __construct(Founder $founderObject)
    {
        $this->founderObject = $founderObject;
    }
    public function collection($inputs)
    {
        $data = $this->founderObject->get()->all();
        return $data;
        
    }
    

    public function store($inputs)
{
    $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
           
       DB::beginTransaction();
         $data= $this->founderObject->create([
            'name'  => $inputs['name'],
            'image' => $imageName,
            'description' => $inputs['description'],
            'mobile' => $inputs['mobile'],
            'email' => $inputs['email'],
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
        $data = $this->founderObject->findOrFail($id);

        return $data;
    }

    public function update(int $id, $inputs)

    {
        
        $data= $this->founderObject->findOrFail($id);
    
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
            'description'=>$inputs['description'],
            'mobile'=>$inputs['mobile'],
            'email'=>$inputs['email'],
        ]);
    
        return $data;
    }
    
    
    public function delete($id)
    {
        // $id = auth()->id();
        $data = $this->founderObject->findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}



