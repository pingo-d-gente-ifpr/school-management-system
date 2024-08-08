<?php

namespace App\Http\Repositories;
use App\Models\User;

class UserRepository{

    public function getUsers(array $filter = null)
    {
        return User::filter($filter)->paginate(7);
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

    public function getTeachers()
    {
        return User::where('role', 'Teacher')->get();
    }

}
