<?php

namespace App\Services;

use App\Models\WhyChooseUs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WhyChooseUsService
{
    /**
     * Create a new class instance.
     */
    protected $whyChooseUsObject;
    public function __construct()
    {
        $this->whyChooseUsObject = new WhyChooseUs;
       
    }

    public function collection($inputs)
    {
        $data = $this->whyChooseUsObject->get()->all();
        return $data;
    }

    public function store($inputs){
        DB::beginTransaction();
        $img = $inputs['image'];
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(storage_path('app/public/assets'), $imageName);
        $data = WhyChooseUs::create([
        'image' => $imageName,
        'description'=>$inputs['description'],
        'title1'=>$inputs['title1'],
        'description1'=>$inputs['description1'],
        'title2'=>$inputs['title2'],
        'description2'=>$inputs['description2'],
        'title3'=>$inputs['title3'],
        'description3'=>$inputs['description3'],
        'title4'=>$inputs['title4'],
        'description4'=>$inputs['description4'],
        'title5'=>$inputs['title5'],
        'description5'=>$inputs['description5'],

        ]);
        DB::commit();
        return $data;

    }
    
    public function resource($id)
    {
        $data = $this->whyChooseUsObject->findOrFail($id);
        return $data;
    }

    public function update($id, $inputs)

    {
        $data = $this->whyChooseUsObject->findOrFail($id);
       
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
        'image' => $imageName,
        'description'=>$inputs['description'],
        'title1'=>$inputs['title1'],
        'description1'=>$inputs['description1'],
        'title2'=>$inputs['title2'],
        'description2'=>$inputs['description2'],
        'title3'=>$inputs['title3'],
        'description3'=>$inputs['description3'],
        'title4'=>$inputs['title4'],
        'description4'=>$inputs['description4'],
        'title5'=>$inputs['title5'],
        'description5'=>$inputs['description5'],

        ]);
        DB::commit();
        $success['message'] = "Data updated successfully";
        return $success;
    }
    public function delete($id)
    {
        $data = $this->whyChooseUsObject->findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}
