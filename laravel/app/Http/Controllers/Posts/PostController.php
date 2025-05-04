<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Http\Requests\Comments\StoreCommentRequest;
use App\Services\Posts\PostService;
use App\Services\Comments\CommentService;

class PostController extends Controller
{
    protected $postService;
    protected $commentService;

    public function __construct(PostService $postService, CommentService $commentService)
    {
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postService->getPostWithComments($id);
        return view('posts.show', compact('post'));
    }

    public function storeComment(StoreCommentRequest $request, $postId)
    {
        $this->commentService->createCommentForPost($postId, $request->validated());
        return back()->with('success', 'Comment added successfully.');
    }

    // Остальные методы аналогично UserController
}