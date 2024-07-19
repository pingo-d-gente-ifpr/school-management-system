<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SubjectRepository;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Services\SubjectService;
use App\Models\Subject;
use Carbon\Carbon;

class SubjectController extends Controller
{
    protected $service;
    protected $repository;
    protected $userController;

    public function __construct(SubjectService $service, SubjectRepository $repository, UserController $userController)
    {
        $this->service = $service;
        $this->repository = $repository;
        $this->userController = $userController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = $this->service->index();
        $teachers = $this->userController->getTeachers();
        return view('admin.subjects.index')->with('subjects', $subjects)->with('teachers', $teachers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
