<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventsCategoryController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FounderController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MainFacilityController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VisionMissionController;
use App\Http\Controllers\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

// Default Welcome and Index Pages
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('/sme_Cpanel/login');
});
Route::get('/contact', function () {
    return view('/frontend/pages/contact');
});
Route::post('/contact', function () {
    return view('/frontend/pages/contact');
});
route::get('dynamic/sme_Cpanel/our-solution',function(){
    return view('/sme_Cpanel/pages/solution');
});

Route::post('/home_facility', function(){
    return view('/sme_Cpanel/pages/home_feature');
});
Route::get('sme_Cpanel/edit_feature/{id}', [MainFacilityController::class, 'editView'])->name('facility.edit.view');
Route::get('sme_Cpanel/edit_testimonial/{id}', [TestimonialController::class, 'editView'])->name('facility.edit.view');
Route::get('sme_Cpanel/edit_solution/{id}', [SolutionController::class, 'editView'])->name('facility.edit.view');

Route::view('/frontend/mail/email','/frontend/mail/email');


Route::view('/index', '/sme_Cpanel/index');

// Group for Dynamic New Horizon CPANEL Routes

    Route::prefix('dynamic/sme_Cpanel')->group(function () {
        // Home-related pages
        Route::middleware('auth:sanctum')->post('/logout', 'AuthController@logout');
        Route::view('/why', 'sme_Cpanel.pages.home_why');
        Route::view('/home_testimonial', 'sme_Cpanel.pages.home_testimonial');
        Route::view('/home_feature', 'sme_Cpanel.pages.home_feature');
        Route::view('/corporate_hire', 'sme_Cpanel.pages.corporate_hire');
        Route::view('/employee_transportation', 'sme_Cpanel.pages.employee_transportation');
        Route::view('/fleet_management', 'sme_Cpanel.pages.fleet_management');
        Route::view('/program', 'pages.program');
        Route::view('/contact-enquiry', 'sme_Cpanel.pages.contact_enquiry');
        Route::view('/about', 'sme_Cpanel.pages.about');
        Route::view('/contact', 'sme_Cpanel.pages.contact');
        Route::view('/founder', 'sme_Cpanel.pages.founder');
        Route::view('/fleet', 'sme_Cpanel.pages.fleet');
    });

Route::view('/home','/frontend/pages/home');
Route::view('/about','/frontend/pages/about');
Route::view('/founders','/frontend/pages/founders');
Route::view('/contact','/frontend/pages/contact');
Route::view('/corporate_hire','/frontend/pages/corporate_hire');
Route::view('/employee_transportation','/frontend/pages/employee_transportation');
Route::view('/enquiry','/frontend/pages/enquiry');
Route::view('/fleet_management','/frontend/pages/fleet_management');
Route::view('/fleet','/frontend/pages/fleet');
Route::view('/our_solutions','/frontend/pages/our_solutions');
