<?php

namespace App\Http\Services;
use App\Http\Repositories\UserRepository;
use App\Models\User;

class UserService{

    protected $repository;
    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->getUsers();
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }
}
