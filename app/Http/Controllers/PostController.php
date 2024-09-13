<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Services\PostService;
use App\Models\Post;

class PostController extends Controller
{
    protected $service;
    protected $repository;
    protected $userController;

    public function __construct(PostService $service, PostRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data, $request);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $this->service->update($data, $post, $request);
        return back()->with('msg','Postagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->service->destroy($post);
        return back()->with(['msg' => 'Postagem deletada com sucesso!']);
    }
}
