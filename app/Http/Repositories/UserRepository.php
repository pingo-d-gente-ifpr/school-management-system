<?php

namespace App\Http\Repositories;
use App\Models\User;

class UserRepository{

    public function getUsers(){
        return User::all();
    }

    public function store(array $data){
        dd($data);
        $user = User::create($data);
    }

}
