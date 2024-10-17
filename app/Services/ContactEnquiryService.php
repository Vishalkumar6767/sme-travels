<?php

namespace App\Services;

use App\Mail\WelcomeEmail;
use App\Models\ContactEnquiry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactEnquiryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }
        public function collection(){
            $data = ContactEnquiry::paginate(4);
            $total_count = count($data);
           
            return $data;

        }
        public function store($inputs)
{
    DB::beginTransaction();
    
    try {
        // Create the contact enquiry
        $contactEnquiry = ContactEnquiry::create([
            'name' => $inputs['name'],
            'mobile' => $inputs['mobile'],
            'email' => $inputs['email'],
            'message' => $inputs['message'],
        ]);

        // Add company details if they exist
        if (!empty($inputs['company_name']) && !empty($inputs['company_address'])) {
            $contactEnquiry->company_name = $inputs['company_name'];
            $contactEnquiry->company_address = $inputs['company_address'];
            $contactEnquiry->save();
        }

        // Commit the transaction after successful data insertion
        DB::commit();
        
        // Call the sendEmail method to send the email
        $result = $this->sendEmail($inputs);
        
        // Log the result of sending the email
        \Log::info('Email sending result: ' . json_encode($result));

        // Return success message with the new contact enquiry ID
        return ['message' => "Data added and email sent successfully", 'id' => $contactEnquiry->id];
        
    } catch (\Exception $e) {
        // Rollback in case of error
        DB::rollBack();
        \Log::error('Error in store method: ' . $e->getMessage());
        return ['error' => "Failed to add data: " . $e->getMessage()];
    }
}

public function sendEmail($inputs)
{
    try {
        $to = $inputs['email'];
        $msg = "Thank you for your enquiry. We will get back to you shortly!";
        $subject = "Welcome to SME Travels";
        $userName = $inputs['name'];
        
        Mail::to($to)->send(new WelcomeEmail($msg, $subject, $userName));
        return ['success' => true, 'message' => 'Email sent successfully'];
    } catch (\Exception $e) {
        \Log::error('Error sending email: ' . $e->getMessage());
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
        
        public function resource($id){
            $data = ContactEnquiry::findOrFail($id);
            return $data;
        }
        public function update($id,$inputs){
            $data = ContactEnquiry::findOrFail($id);
            $data = $data->update($inputs);
            return $data;

        }
        public function delete($id){
            $data = ContactEnquiry::findOrFail($id);
            $data = $data->delete($id);
            return $success['message'] ="data deleted successfully";
        }
    
}
