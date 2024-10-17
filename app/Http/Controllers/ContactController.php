<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\ContactService;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $contactService;
    public function __construct(){
        $this->contactService = new ContactService;
    }
    public function index()
    {
        $data = $this->contactService->collection()->all();
        if(isset($data['errors'])){
            return response()->json($data['errors'],$data);
        }
        return response()->json($data,200); 
        // return view('sme_Cpanel.pages.contact');
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $contact = $this->contactService->store($request->validated());
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
       return response()->json($contact,200);

    }

    
    public function show(string $id)
    {
        $contact = $this->contactService->resource($id);
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
        return response()->json($contact,200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $contact = Contact::findOrFail($id);
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
        return response()->json($contact,200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, ContactRequest $request)
    {
        $contact = $this->contactService->update($id,$request);
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
        return response()->json($contact,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = $this->contactService->delete($id);
        if(isset($contact['errors'])){
            return response()->json($contact['errors'],400 );

        }
        return response()->json($contact,200);
       
    }
}
