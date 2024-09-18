<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateChildrenSubjectRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Http\Services\ClassService;
use App\Models\Children;
use App\Models\ChildrenSubject;
use App\Models\Classe;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    protected $service;
    protected $userController;

    public function __construct(ClassService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = $request->only('q');
    
        return view('admin.classes.index')->with('classes', $this->service->index($filter));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $childrens = Children::all();
        $teachers = User::where('role', Role::teacher)->get();
        return view('admin.classes.create')
        ->with('subjects',$subjects)
        ->with('teachers',$teachers)
        ->with('childrens',$childrens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data, $request);
        return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $class,  Request $request)
    {
        $class = $this->service->show($class);

        $subjects = $class->subjects()->get();
        $students = $class->childrens()->get();

        $startDate = $request->input('selected_date') ? Carbon::createFromFormat('d/m/Y', $request->input('selected_date')) : Carbon::now();
        $weekDays = [];
        for ($i = 0; $i < 5; $i++) {
            $date = $startDate->copy()->addDays($i);
            $weekDays[$date->format('Y-m-d')] = $date->format('d/m (l)');
    }

        $frequencies = DB::table('children_classe')
        ->join('children_frequency', 'children_classe.id', '=', 'children_frequency.children_classe_id')
        ->where('children_classe.classe_id', $class->id)
        ->select('children_classe.children_id', 'children_frequency.*')
        ->get();
       
        $studentsFrequencies = [];
        foreach ($frequencies as $frequency) {
            $studentsFrequencies[$frequency->children_id][] = $frequency;
        }


        return view('front.classes.show')
            ->with('class', $class)
            ->with('subjects', $subjects)
            ->with('students', $students)
            ->with('weekDays', $weekDays)
            ->with('studentsFrequencies', $studentsFrequencies);
    }

    public function registerGrades(Request $request)
    {
        foreach ($request->input('score1') as $studentId => $subjects) {
            foreach ($subjects as $subjectId => $score1) {
                $score2 = $request->input('score2')[$studentId][$subjectId] ?? null;
                $score3 = $request->input('score3')[$studentId][$subjectId] ?? null;
                $score4 = $request->input('score4')[$studentId][$subjectId] ?? null;
                $childrenSubject = ChildrenSubject::where('children_id', $studentId)
                    ->where('classe_subject_id', $subjectId)
                    ->first();
    
                if ($childrenSubject) {
                    if ($score1 !== null) $childrenSubject->score1 = $score1;
                    if ($score2 !== null) $childrenSubject->score2 = $score2;
                    if ($score3 !== null) $childrenSubject->score3 = $score3;
                    if ($score4 !== null) $childrenSubject->score4 = $score4;
                    $childrenSubject->save();
                } else {
                    ChildrenSubject::create([
                        'children_id' => $studentId,
                        'classe_subject_id' => $subjectId,
                        'score1' => $score1,
                        'score2' => $score2,
                        'score3' => $score3,
                        'score4' => $score4
                    ]);
                }
            }
        }
    
        return redirect()->back()->with('success', 'Notas atualizadas com sucesso!');
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $class)
    {
        $subjects = Subject::all();
        $childrens = Children::all();
        $teachers = User::where('role', Role::teacher)->get();
        return view('admin.classes.edit')->with('class', $class)
        ->with('subjects',$subjects)
        ->with('teachers',$teachers)
        ->with('childrens',$childrens);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $class)
    {   
        $data = $request->validated();
        $this->service->update($data, $class, $request);
        return to_route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $this->service->destroy($classe);
        return redirect()->route('classes.index');
    }

    public function registerFrequency(Request $request)
    {
        $data = $request->all();
        $this->service->registerFrequency($data);
        return response()->json(['message' => 'Dados recebidos com sucesso']);
    }
    
}
