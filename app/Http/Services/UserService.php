<?php

namespace App\Http\Services;
use App\Http\Repositories\UserRepository;
use App\Models\User;

class UserService{

    protected $repository;
    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function index(array $filter = null)
    {
        return $this->repository->getUsers($filter);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(array $data, User $user)
    {
        return $this->repository->update($data, $user);
    }
    
    public function destroy(User $user)
    {
        return $this->repository->destroy($user);
    }

    public function getTeachers()
    {
        return $this->repository->getTeachers();
    }
}
