<?php

namespace App\Services\Posts;

use App\Models\Posts\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;


class PostService
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function getPostById(string $id)
    {
        return Post::find($id);
    }

    public function getPostWithComments(string $id)
    {
        return Post::with(['user', 'comments.user'])->find($id);
    }

    public function createPost(array $data): Post
    {
        $post = Post::create($data);
        PostStoreJob::dispatch($data);
    }

    public function updatePost(Post $post, array $data): Post
    {
        $post->update($data);
        return $post;
    }

    // public function deletePost(string $id)
    // {
    //     $post = $this->getPostById($id);
    //     return $post->delete();
    // }

}