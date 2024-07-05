<?php

namespace App\Http\Services;

use App\Http\Repositories\SubjectRepository;
use App\Models\Subject;

class SubjectService{

    protected $repository;
    public function __construct(SubjectRepository $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->getAll();
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(array $data, Subject $subject)
    {
        return $this->repository->update($data, $subject);
    }
    
    public function destroy(Subject $subject)
    {
        return $this->repository->destroy($subject);
    }
}
