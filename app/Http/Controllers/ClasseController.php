<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Http\Services\ClassService;
use App\Models\Classe;
use App\Models\Subject;
use Illuminate\Http\Request;

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
    public function index()
    {
       
        
        return view('admin.classes.index')->with('classes', $this->service->index());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('admin.classes.create')->with('subjects',$subjects);
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
    public function show(Classe $class)
    {
        $class = $this->service->show($class);
        $subjects = $class->subjects()->get();
        return view('front.classes.show')->with('class', $class)->with('subjects',$subjects);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $class)
    {
        $subjects = Subject::all();
        return view('admin.classes.edit')->with('class', $class)->with('subjects',$subjects);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $class)
    {
        $data = $request->validated();
        $this->service->update($data,$class, $request);

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
}
