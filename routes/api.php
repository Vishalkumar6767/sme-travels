<?php

use App\Http\Controllers\{
    AboutUsController,
    ActivityController,
    AuthController,
    ContactController,
    ContactEnquiryController,
    CorporateHireController,
    EmployeeTransportationController,
    EventController,
    EventsCategoryController,
    FacilityController,
    FleetController,
    FleetManagementController,
    FounderController,
    MainFacilityController,
    ProgramController,
    SolutionController,
    TestimonialController,
    UserController,
    VisionMissionController,
    WhyChooseUsController
};
use Illuminate\Support\Facades\Route;

// Public GET, POST, and EDIT routes for resources
Route::get('contact', [ContactController::class, 'index']);
Route::get('contact/{contact}', [ContactController::class, 'show']);
Route::get('contact/{contact}/edit', [ContactController::class, 'edit']);
Route::post('contact', [ContactController::class, 'store']);

Route::get('contact-enquiry', [ContactEnquiryController::class, 'index']);
Route::get('contact-enquiry/{contact_enquiry}', [ContactEnquiryController::class, 'show']);
Route::get('contact-enquiry/{contact_enquiry}/edit', [ContactEnquiryController::class, 'edit']);
Route::post('contact-enquiry', [ContactEnquiryController::class, 'store']);

Route::get('our-solution', [SolutionController::class, 'index']);
Route::get('our-solution/{solution}', [SolutionController::class, 'show']);
Route::get('our-solution/{solution}/edit', [SolutionController::class, 'edit']);
Route::post('our-solution', [SolutionController::class, 'store']);

Route::get('corporate-hire', [CorporateHireController::class, 'index']);
Route::get('corporate-hire/{id}', [CorporateHireController::class, 'show']);
Route::get('corporate-hire/{id}/edit', [CorporateHireController::class, 'edit']);
Route::post('corporate-hire', [CorporateHireController::class, 'store']);

Route::get('employee-transportation', [EmployeeTransportationController::class, 'index']);
Route::get('employee-transportation/{employee_transportation}', [EmployeeTransportationController::class, 'show']);
Route::get('employee-transportation/{employee_transportation}/edit', [EmployeeTransportationController::class, 'edit']);
Route::post('employee-transportation', [EmployeeTransportationController::class, 'store']);

Route::get('fleet-management', [FleetManagementController::class, 'index']);
Route::get('fleet-management/{fleet_management}', [FleetManagementController::class, 'show']);
Route::get('fleet-management/{fleet_management}/edit', [FleetManagementController::class, 'edit']);
Route::post('fleet-management', [FleetManagementController::class, 'store']);

Route::get('founder', [FounderController::class, 'index']);
Route::get('founder/{id}', [FounderController::class, 'show']);
Route::get('founder/{id}/edit', [FounderController::class, 'edit']);
Route::post('founder', [FounderController::class, 'store']);

Route::get('vision-mission', [VisionMissionController::class, 'index']);
Route::get('vision-mission/{id}', [VisionMissionController::class, 'show']);
Route::get('vision-mission/{id}/edit', [VisionMissionController::class, 'edit']);
Route::post('vision-mission', [VisionMissionController::class, 'store']);

Route::get('about', [AboutUsController::class, 'index']);
Route::get('about/{id}', [AboutUsController::class, 'show']);
Route::get('about/{id}/edit', [AboutUsController::class, 'edit']);
Route::post('about', [AboutUsController::class, 'store']);

Route::get('feature', [MainFacilityController::class, 'index']);
Route::get('feature/{id}', [MainFacilityController::class, 'show']);
Route::get('feature/{id}/edit', [MainFacilityController::class, 'edit']);
Route::post('feature', [MainFacilityController::class, 'store']);

Route::get('fleet', [FleetController::class, 'index']);
Route::get('fleet/{id}', [FleetController::class, 'show']);
Route::get('fleet/{id}/edit', [FleetController::class, 'edit']);
Route::post('fleet', [FleetController::class, 'store']);

Route::get('home_testimonial', [TestimonialController::class, 'index']);
Route::get('home_testimonial/{id}', [TestimonialController::class, 'show']);
Route::get('home_testimonial/{id}/edit', [TestimonialController::class, 'edit']);
Route::post('home_testimonial', [TestimonialController::class, 'store']);

Route::get('home_why', [WhyChooseUsController::class, 'index']);
Route::get('home_why/{id}', [WhyChooseUsController::class, 'show']);
Route::get('home_why/{id}/edit', [WhyChooseUsController::class, 'edit']);
Route::post('home_why', [WhyChooseUsController::class, 'store']);

// Public Auth Routes
Route::post('login', [AuthController::class, 'login']);
Route::post('users', [UserController::class, 'store']);

// Routes that require authentication for update and delete
Route::middleware('auth:sanctum')->group(function () {
    Route::put('our-solution/{id}', [SolutionController::class, 'update']);
    Route::delete('our-solution/{id}', [SolutionController::class, 'destroy']);

    Route::put('corporate-hire/{id}', [CorporateHireController::class, 'update']);
    Route::delete('corporate-hire/{id}', [CorporateHireController::class, 'destroy']);

    Route::put('employee-transportation/{id}', [EmployeeTransportationController::class, 'update']);
    Route::delete('employee-transportation/{id}', [EmployeeTransportationController::class, 'destroy']);

    Route::put('fleet-management/{id}', [FleetManagementController::class, 'update']);
    Route::delete('fleet-management/{id}', [FleetManagementController::class, 'destroy']);

    Route::put('founder/{id}', [FounderController::class, 'update']);
    Route::delete('founder/{id}', [FounderController::class, 'destroy']);

    Route::put('vision-mission/{id}', [VisionMissionController::class, 'update']);
    Route::delete('vision-mission/{id}', [VisionMissionController::class, 'destroy']);

    Route::put('about/{id}', [AboutUsController::class, 'update']);
    Route::delete('about/{id}', [AboutUsController::class, 'destroy']);

    Route::put('feature/{id}', [MainFacilityController::class, 'update']);
    Route::delete('feature/{id}', [MainFacilityController::class, 'destroy']);

    Route::put('fleet/{id}', [FleetController::class, 'update']);
    Route::delete('fleet/{id}', [FleetController::class, 'destroy']);

    Route::put('home_testimonial/{id}', [TestimonialController::class, 'update']);
    Route::delete('home_testimonial/{id}', [TestimonialController::class, 'destroy']);

    Route::put('home_why/{id}', [WhyChooseUsController::class, 'update']);
    Route::delete('home_why/{id}', [WhyChooseUsController::class, 'destroy']);

    Route::put('contact/{id}', [ContactController::class, 'update']);
    Route::delete('contact/{id}', [ContactController::class, 'destroy']);
    
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('change-password',[AuthController::class,'changePassword']);

    // Authenticated-only resources
    Route::resources([
        'home_facility' => FacilityController::class,
        'activity' => ActivityController::class,
        'events' => EventsCategoryController::class,
        'event_details' => EventController::class,
        'programs' => ProgramController::class,
    ]);
});
