<?php

namespace App\Services;

use App\Models\Solution;
use Illuminate\Support\Facades\Storage;

class SolutionService
{
    /**
     * Create a new class instance.
     */
    protected $solutionObject;
    public function __construct()
    {
        $this->solutionObject = new Solution();
       
    }

    public function collection($inputs)
    {
        $data = $this->solutionObject->get();
        return $data;
        
    }
    
    public function store($inputs)
{
   
    $img = $inputs['image'];
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(storage_path('app/public/assets'), $imageName);
       $solution = $this->solutionObject->create([
            'name'  => $inputs['name'],
            'image' => $imageName,
            'description'=>$inputs['description']
        ]);
        $data = [
            'status' => true,
                'message' => "Image uploaded successfully",
                'path' => asset('storage/assets/' . $imageName),
                'data' => $solution
            ];
           return $data;
        
    }

    public function resource(int $id)
    {

        $data = $this->solutionObject->findOrFail($id);
        return $data;
    }

    public function update(int $id, $inputs)
    {  
        $solution = $this->solutionObject->findOrFail($id);
        
        if ($inputs['image']) {
            if ($solution->image && Storage::exists('public/assets/' . $solution->image)) {
                Storage::delete('public/assets/' . $solution->image);
            }
    
            $imageName = time() . '.' . $inputs['image']->getClientOriginalExtension();
            $inputs['image']->storeAs('public/assets', $imageName);
        } else {
            $imageName = $solution->image;
        }
        $solution->update([
            'name' => $inputs['name'],
            'image' => $imageName,
            'description'=>$inputs['description']
        ]);
    
        return $solution;
    }
    
    
    public function delete($id)
    {
        // $id = auth()->id();
        $data = $this->solutionObject->findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}
