<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function login($inputs){
        $user = User::where('email', $inputs['email'])->first();

        if (isset($user)) {
            if (Hash::check($inputs['password'], $user->password)) {
                Auth::login($user);
                $data = [
                    'user' => $user,
                    'token' => $user->createToken(config('site.api_token'))->plainTextToken,
                    'token_type'=>'bearer'
                ];
                return $data;
            } else {
                return ['errors' => ['The User credentials are invalid']];
            }
        } else {
            return ['message' => 'Please enter a valid user name'];
        }
    }
    public function logout($inputs)
    {
        $user = $inputs->user();
        $user->tokens()->delete();
        $data['message'] = 'Successfully logged out';
        return $data;
    }
    public function changePassword($inputs){
        $userId = auth()->id();
        $user = User::findOrFail($userId);
        DB::beginTransaction();
        if(Hash::check($inputs['old_password'], $user['password'])){
            $user->update([
                'password' => $inputs['password'],
            ]);
        }else{
          $message['error'] =[
                'message' =>"Password does not matched kindly review you Password",
                'code'=>400
            ];
            return $message;
        }
    
    }
   
}