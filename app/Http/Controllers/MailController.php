<?php

namespace App\Http\Controllers;

use App\Services\ContactEnquiryService;
use Illuminate\Http\Request;


class MailController extends Controller
{
    protected $contactEnquiry;
    public function   __construct(ContactEnquiryService $contactEnquiry){
        $this->contactEnquiry = $contactEnquiry;

    }

}
