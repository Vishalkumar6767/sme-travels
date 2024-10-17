<?php

namespace App;

use App\Models\User;

class UserService
{
    /**
     * Create a new class instance.
     */
    protected $userObject;
    public function __construct()
    {
        $this->userObject = new User();
        
    }
    public function store($inputs){
        $user = $this->userObject->create([
            'role_id' => $inputs['role_id'],
            'name'=> $inputs['name'],
            'email'=> $inputs['email'],
            'phone' => $inputs['phone'],
            'password' =>$inputs['password']
        ]);
        return $user;

    }

    
}