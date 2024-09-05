<?php

namespace App\Http\Repositories;

use App\Models\Post;

class PostRepository {

    public function store(array $data)
    {
       return Post::create($data);
    }

    public function update(array $data, Post $subject)
    {
        return $subject->update($data);
    }

     public function destroy(Post $subject)
    {
        return $subject->delete();
    }

}
