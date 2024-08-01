<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Services\ChildrenService;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $service;
    protected $repository;
    protected $childrenService;

    public function __construct(UserService $service, UserRepository $repository, ChildrenService $childrenService)
    {
        $this->service = $service;
        $this->repository = $repository;
        $this->childrenService = $childrenService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->service->index();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('photo')){
          $data['photo'] = $request->file('photo')->store('images/users', 'public');
        }
        $user = $this->service->store($data);

        if(!empty($data['childrens'])) $this->createChildrens($data['childrens'], $user);

        event(new Registered($user));
        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('images/users', 'public');
        }
        $this->service->update($data,$user);
        return to_route('users.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->photo){
            Storage::disk('public')->delete($user->photo);
        }
        $this->service->destroy($user);
        return to_route('users.index')->with('deletado',"Usuário " . $user->name . " deletado com sucesso!");
    }

    public function getTeachers()
    {
        $teachers = $this->service->getTeachers();
        return $teachers;
    }

    public function createChildrens(array $data, User $user)
    {
        // dd($data);
        $this->childrenService->createChildrens($data,$user);
    }
}
