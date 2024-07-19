<?php

namespace App\Http\Services;

use App\Http\Repositories\SubjectRepository;
use App\Models\Subject;
use Carbon\Carbon;

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
        $this->convertToDate($data);
        if(!$data['user_id'])$data['user_id'] = auth()->id();
        if($request->hasFile('photo'))
        {
            $data['photo'] = $request->file('photo')->store('images/subjects', 'public');
        }

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

    public function convertToDate(array $data)
    {
        $startString = $data['start_date'];
        $endString = $data['end_date'];
        $currentDate = Carbon::now()->toDateString();
        $data['start_date'] = Carbon::createFromFormat('Y-m-d H:i', "$currentDate $startString")->toDateTimeString();
        $data['end_date'] = Carbon::createFromFormat('Y-m-d H:i', "$currentDate $endString")->toDateTimeString();

    }
}
