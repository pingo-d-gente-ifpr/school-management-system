<?php

namespace App\Http\Repositories;

use App\Models\Subject;

class SubjectRepository{

    public function getAll()
    {
        return Subject::paginate(8);
    }

    public function store(array $data)
    {
       return Subject::create($data);
    }

    public function update(array $data, Subject $subject)
    {
        return $subject->update($data);
    }

     public function destroy(Subject $subject)
    {
        return $subject->delete();
    }

}
