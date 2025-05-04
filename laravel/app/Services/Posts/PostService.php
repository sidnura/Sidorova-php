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

    public function createPost(array $data, ?UploadedFile $image = null): Post
    {
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $data['user_id']
        ]);
        
    
        if (isset($data['image'])) {
            $post->addMedia($data['image']->getPathname())
                 ->usingFileName($data['image']->getClientOriginalName())
                 ->toMediaCollection('posts');
        }
        return $post;
    }

    public function updatePost(string $id, array $data)
    {
        $post = $this->getPostById($id);
        $post->update($data);
        return $post;
    }

    // public function deletePost(string $id)
    // {
    //     $post = $this->getPostById($id);
    //     return $post->delete();
    // }

}