<?php

namespace App\Http\Repositories;

use App\Models\Classe;

class ClassRepository 
{

    public function getAll(array $filter)
    {
        return Classe::filter($filter)->paginate(8);
    }

    public function store(array $data)
    {
       return Classe::create($data);
    }

    public function show(Classe $class)
    {
        return Classe::find($class->id);
    }

    public function update(array $data, Classe $class)
    {
        $class->update($data);
        $updatedClass = Classe::find($class->id);
        return $updatedClass;
    }

     public function destroy(Classe $class)
    {
        return $class->delete();
    }

}
