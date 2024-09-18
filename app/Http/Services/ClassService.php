<?php

namespace App\Http\Services;

use App\Http\Repositories\ClassRepository;
use App\Models\ChildrenClasse;
use App\Models\ChildrenFrequency;
use App\Models\Classe;
use Illuminate\Support\Facades\Auth;
use App\Enums\Role;
use Carbon\Carbon;
use App\Models\ChildrenSubject;
use App\Models\ClasseSubject;
use App\Models\Children;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassService{

    protected $repository;

    public function __construct(ClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(array $filter)
    {
        $user = Auth::user();
    
        if ($user->role == Role::admin->name) {
            $classes = Classe::paginate(6);
        }
        else if ($user->role == Role::teacher->name) {
            $classes = ClasseSubject::where('user_id', $user->id)
                                    ->with('classe')
                                    ->paginate(6); 
    
            $classes->getCollection()->transform(function($item) {
                return $item->classe;
            })->unique();
        }
        else if ($user->role == Role::parents->name) {
            $childrenClasses = Children::where('user_id', $user->id)
                                        ->with('classes')
                                        ->get()
                                        ->pluck('classes')
                                        ->flatten()
                                        ->unique();
    
            $classes = $this->paginateCollection($childrenClasses, 6);
        }
    
        return $classes;
    }

    public function paginateCollection($items, $perPage = 6, $page = null, $options = [])
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            $options
        );
    }

    

    public function store(array $data, $request)
    {
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('images/classes', 'public');
        }

        $class = $this->repository->store($data);

        if (isset($data['subjects']) && !empty($data['subjects'])) {
            $class->subjects()->attach($data['subjects']);
        }

        if (isset($data['childrens']) && !empty($data['childrens'])) {
            $class->childrens()->attach($data['childrens']);
        }

        $class->save();

        return $class;
}


    public function show(Classe $class)
    {
        return $this->repository->show($class);
    }

    public function update(array $data, Classe $class, $request)
    {

        if($request->hasFile('photo'))
        {
            $data['photo'] = $request->file('photo')->store('images/classes', 'public');
        }

        $class = $this->repository->update($data, $class);
        $class->subjects()->sync($data['subjects']??[]);
        $class->childrens()->sync($data['childrens']??[]);
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

    public function registerFrequency($data)
    {
        $childrenClass = ChildrenClasse::find($data['children_classe_id']);
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        
        if($data['attendance'] == 'false'){
            $data['attendance'] = false;
        }else{
            $data['attendance'] = true;
        }

        $frequencyExists = $childrenClass->frequencies()->where('date', $data['date'])->first();

        if(!$frequencyExists){
            return $childrenClass->frequencies()->create($data);
        }

        return $frequencyExists->update($data);
    }

    public function getFormOptions()
    {
        $subjects = Subject::all();
        $childrens = Children::all();
        $teachers = User::where('role', Role::teacher)->get();

        return compact('subjects', 'teachers', 'childrens');
    }

    public function getClassDetails(Classe $class)
    {
        $subjects = $class->subjects()->get();
        $students = $class->childrens()->get();

        $startDate = Carbon::now();
        $weekDays = [];
        for ($i = 0; $i < 5; $i++) {
            $date = $startDate->copy()->addDays($i);
            $weekDays[$date->format('Y-m-d')] = $date->format('d/m (l)');
        }

        return compact('class', 'subjects', 'students', 'weekDays');
    }

    public function registerGrades($scores)
    {
        foreach ($scores['score1'] as $studentId => $subjects) {
            foreach ($subjects as $subjectId => $score1) {
                $score2 = $scores['score2'][$studentId][$subjectId] ?? null;
                $score3 = $scores['score3'][$studentId][$subjectId] ?? null;
                $score4 = $scores['score4'][$studentId][$subjectId] ?? null;

                // Garanta que $scoreData tem o formato correto
                $scoreData = [
                    'score1' => $score1,
                    'score2' => $score2,
                    'score3' => $score3,
                    'score4' => $score4
                ];

                // Atualize ou crie a nota
                $this->updateOrCreateChildrenSubject($studentId, $subjectId, $scoreData);
            }
        }
    }

    private function updateOrCreateChildrenSubject($studentId, $subjectId, $scoreData)
    {
        $childrenSubject = ChildrenSubject::where('children_id', $studentId)
            ->where('classe_subject_id', $subjectId)
            ->first();
    
        if ($childrenSubject) {
            if (isset($scoreData['score1']) && $scoreData['score1'] !== null) $childrenSubject->score1 = $scoreData['score1'];
            if (isset($scoreData['score2']) && $scoreData['score2'] !== null) $childrenSubject->score2 = $scoreData['score2'];
            if (isset($scoreData['score3']) && $scoreData['score3'] !== null) $childrenSubject->score3 = $scoreData['score3'];
            if (isset($scoreData['score4']) && $scoreData['score4'] !== null) $childrenSubject->score4 = $scoreData['score4'];
            $childrenSubject->save();
        } else {
            ChildrenSubject::create([
                'children_id' => $studentId,
                'classe_subject_id' => $subjectId,
                'score1' => $scoreData['score1'],
                'score2' => $scoreData['score2'],
                'score3' => $scoreData['score3'],
                'score4' => $scoreData['score4']
            ]);
        }
    }    
}
