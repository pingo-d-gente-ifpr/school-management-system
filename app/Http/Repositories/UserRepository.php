<?php

namespace App\Http\Repositories;
use App\Models\User;

class UserRepository{

    public function getUsers()
    {
        return User::all();
    }

    public function store(array $data)
    {
       return User::create($data);
    }

    public function update(array $data, User $user)
    {
        return $user->update($data);
    }

     public function destroy(User $user)
    {
        return $user->delete();
    }

}
