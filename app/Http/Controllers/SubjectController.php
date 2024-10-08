<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SubjectRepository;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Services\SubjectService;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $service;
    protected $repository;
    protected $userController;

    public function __construct(SubjectService $service, SubjectRepository $repository, UserController $userController)
    {
        $this->authorizeResource(Subject::class, 'subject');
        $this->service = $service;
        $this->repository = $repository;
        $this->userController = $userController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->only('q');
        $subjects = $this->service->index($filter);
        $teachers = $this->userController->getTeachers();
        return view('admin.subjects.index')->with('subjects', $subjects)->with('teachers', $teachers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data, $request);
        return to_route('subjects.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();
        $this->service->update($data, $subject, $request);
        return to_route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $this->service->destroy($subject);
        return to_route('subjects.index');
    }
}
