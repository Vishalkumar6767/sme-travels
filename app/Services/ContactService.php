<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactService
{
    /**
     * Create a new class instance.
     */
    protected $contactObject;
    public function __construct()
    {
        $this->contactObject = new Contact();
    }
    public function collection()
    {
        $contact = $this->contactObject->get();
        return $contact;
    }
    public function store($inputs)
    {

        $img = $inputs['image'];
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(storage_path('app/public/assets'), $imageName);

        DB::beginTransaction();
        $data = $this->contactObject->create([

            'image'        => $imageName,
            'address'      => $inputs['address'],
            'mobile_1'     => $inputs['mobile_1'],
            'mobile_2'     => $inputs['mobile_2'],
            'mobile_3'     => $inputs['mobile_3'],
            'office_no'    => $inputs['office_no'],
            'email'        => $inputs['email'],
            'facebook'     => $inputs['facebook'],
            'instagram'    => $inputs['instagram'],
            'youtube'      => $inputs['youtube'],
            'linkdin'      => $inputs['linkdin'],
        ]);
        DB::commit();

        return $data;
    }

    public function resource($id)
    {
        $contact = $this->contactObject->findOrFail($id);
        $contactImage = $contact['image'];

        $imagePath = $contactImage ? asset('storage/assets/' . $contactImage) : null;
        $contact->image_url = $imagePath;
        return $contact;
    }
    public function update($id, $inputs)
    {
       
        $contact = $this->contactObject->findOrFail($id);
        if ($inputs['image']) {
            if ($contact->image && Storage::exists('public/assets/' . $contact->image)) {
                Storage::delete('public/assets/' . $contact->image);
            }

            $imageName = time() . '.' . $inputs['image']->getClientOriginalExtension();
            $inputs['image']->storeAs('public/assets', $imageName);
        } else {
            $imageName = $contact->image;
        }
        $contact->update([


            'image'        => $imageName,
            'address'      => $inputs['address'],
            'mobile_1'     => $inputs['mobile_1'],
            'mobile_2'     => $inputs['mobile_2'],
            'mobile_3'     => $inputs['mobile_3'],
            'office_no'    => $inputs['office_no'],
            'email'        => $inputs['email'],
            'facebook'     => $inputs['facebook'],
            'instagram'    => $inputs['instagram'],
            'youtube'      => $inputs['youtube'],
            'linkdin'      => $inputs['linkdin'],

        ]);
        $success['message'] = "Data updated successfully";
        return $success;
    }
    public function delete($id)
    {
        $contact = $this->contactObject->findOrFail($id);
        $contact->delete($id);
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}
