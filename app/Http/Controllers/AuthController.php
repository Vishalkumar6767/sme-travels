<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Hash;

class AuthController extends Controller
{
   protected $authService;
   public function __construct(){
    $this->authService = new AuthService;
   }
   public function login(LoginRequest $request){
    $data = $this->authService->login($request->validated());
    if(isset($data['errors'])){
        return response()->json($data['errors'], 400);
    }
    return response()->json($data,200);
   }
   public function logout(Request $request)
   {
       $user = $this->authService->logout($request);
       if (isset($user['errors'])) {
           return response()->json($user['errors'], 400);
       }
    return response()->json($user,200);
   }
   public function changePassword(ChangePasswordRequest $request){
    $data = $this->authService->changePassword($request->validated());
    if(isset($data['error'])){
        return response()->json($data['error'], 400);
    }
    return response()->json($data,200);

   }
  
    
   
   
}
