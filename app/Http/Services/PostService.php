<?php

namespace App\Http\Services;

use App\Http\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService {

    protected $repository;

    public function __construct(PostRepository $repository){
        $this->repository = $repository;
    }

    public function store(array $data, $request)
    {

        if($request->hasFile('photo'))
        {
            $data['photo'] = $request->file('photo')->store('images/posts', 'public');
        }

        return $this->repository->store($data);
    }

    public function update(array $data, Post $post, $request)
    {

        if($request->hasFile('photo'))
        {
            $data['photo'] = $request->file('photo')->store('images/classes', 'public');
        }

        return $this->repository->update($data, $post);       
    }

    public function destroy(Post $post)
    {
        if($post->photo){
            Storage::disk('public')->delete($post->photo);
        }
        return $this->repository->destroy($post);
    }

}
