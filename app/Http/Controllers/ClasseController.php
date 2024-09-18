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
        $classes = $this->service->index($filter);

        return view('admin.classes.index', compact('classes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formOptions = $this->service->getFormOptions();
        return view('admin.classes.create')->with($formOptions);
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
        $scores = [
            'score1' => $request->input('score1'),
            'score2' => $request->input('score2'),
            'score3' => $request->input('score3'),
            'score4' => $request->input('score4'),
        ];

        $this->service->registerGrades($scores);

        return redirect()->back()->with('success', 'Notas atualizadas com sucesso!');
    }

    
    
    public function edit(Classe $class)
    {
        $formOptions = $this->service->getFormOptions();
        return view('admin.classes.edit')->with('class', $class)->with($formOptions);
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
    public function destroy(Classe $class)
    {   
        // dd($class);
        $this->service->destroy($class);
        return redirect()->route('classes.index')->with('success', 'Turma excluída com sucesso!');;
    }

    public function registerFrequency(Request $request)
    {
        $data = $request->all();
        $this->service->registerFrequency($data);
        return response()->json(['message' => 'Dados recebidos com sucesso']);
    }
    
}
