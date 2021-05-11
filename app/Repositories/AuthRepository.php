<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    protected $userModel;


    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function register($user)
    {
        return $this->userModel->create($user);
    }
    


}