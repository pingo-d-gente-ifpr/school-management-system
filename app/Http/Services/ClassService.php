<?php

namespace App\Http\Services;

use App\Http\Repositories\ClassRepository;
use App\Models\Classe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ClassService{

    protected $repository;

    public function __construct(ClassRepository $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->getAll();
    }

    public function store(array $data, $request)
    {
        $userId = $this->validateUser($data);

        if($request->hasFile('photo'))
        {
            $data['photo'] = $request->file('photo')->store('images/classes', 'public');
        }
        
        $class = $this->repository->store($data);

        $this->syncRelations($data, $userId, $class);
        $class->save();

        return $class;
    }

    public function show(Classe $class)
    {
        return $this->repository->show($class);
    }

    public function update(array $data, Classe $class, $request)
    {
        $userId = $this->validateUser($data);

        if($request->hasFile('photo'))
        {
            $data['photo'] = $request->file('photo')->store('images/classes', 'public');
        }

        $class = $this->repository->update($data, $class);

        $this->syncRelations($data, $userId, $class);

        $class->save();

        return $class;
    }
    
    public function destroy(Classe $class)
    {
        if($class->photo){
            Storage::disk('public')->delete($class->photo);
        }
        return $this->repository->destroy($class);
    }


    public function validateUser(array $data)
    {
        if(empty($data['user_id']))
        {
            return auth()->id();
        }

        return $data['user_id'];
    }

    public function syncRelations(array $data, $userId, Classe $class){
        $syncData = collect($data['subjects'] ?? [])->mapWithKeys(function ($subject) use ($userId) {
            return [$subject['id'] => ['user_id' => $userId]];
        })->toArray();

        $class->subjects()->sync($syncData);
    }

}
