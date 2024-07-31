<?php

namespace App\Http\Services;

use App\Http\Repositories\SubjectRepository;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SubjectService{

    protected $repository;
    public function __construct(SubjectRepository $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->getAll();
    }

    public function store(array $data, $request)
    {

        if($request->hasFile('photo'))
        {
            $data['photo'] = $request->file('photo')->store('images/subjects', 'public');
        }

        return $this->repository->store($data);
    }

    public function update(array $data, Subject $subject, $request)
    {

        if($request->hasFile('photo'))
        {
            $data['photo'] = $request->file('photo')->store('images/subjects', 'public');
        }
        return $this->repository->update($data, $subject);
    }
    
    public function destroy(Subject $subject)
    {
        if($subject->photo){
            Storage::disk('public')->delete($subject->photo);
        }
        return $this->repository->destroy($subject);
    }
}
