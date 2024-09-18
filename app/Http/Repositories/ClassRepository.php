<?php

namespace App\Http\Repositories;

use App\Models\Classe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassRepository 
{

    public function getAll(array $filter)
    {
        $user = Auth::user();

        if($user->isParent()){
            $childrenIds = DB::table('childrens')
            ->where('user_id', $user->id)
            ->pluck('id');
    
            $classesIds = DB::table('children_classe')
                ->whereIn('children_id', $childrenIds)
                ->pluck('classe_id');
        
            return Classe::whereIn('id', $classesIds)
                ->filter($filter)
                ->paginate(6);
        }

        if ($user->isTeacher()) {
            $classes = DB::table('classe_subject')
                ->where('user_id', $user->id)
                ->pluck('classe_id');

            return Classe::whereIn('id', $classes)
                ->filter($filter)
                ->paginate(6);
        }
        return Classe::filter($filter)->paginate(6);
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
