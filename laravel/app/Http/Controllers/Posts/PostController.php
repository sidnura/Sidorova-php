<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\User; 

use Illuminate\Http\Request;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Http\Requests\Comments\StoreCommentRequest;
use App\Services\Posts\PostService;
// use App\Services\Comments\CommentService;
use App\Models\Posts\Post;

class PostController extends Controller
{
    protected $postService;
    protected $commentService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        //$this->commentService = $commentService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $users = \App\Models\User::all();
        return view('posts.create', compact('users'));
    }

    public function store(StorePostRequest $request)
    {
        // $post = $this->postService->createPost($request->validated());
        
        // if ($request->hasFile('image')) {
        //     $this->postService->addImageToPost($post, $request->file('image'));
        // }
        
        // return redirect()->route('posts.index')
        //     ->with('success', 'Post created successfully.');
        $post = Post::create($request->validated());
    
        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')
                 ->toMediaCollection('post_images');
        }
        
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        $users = User::all();  
    
        return view('posts.show', compact('post', 'users'));
    }

    // public function show($id)
    // {
    //     $post = $this->postService->getPostWithComments($id);
    //     return view('posts.show', compact('post'));
    // }

    public function storeComment(StoreCommentRequest $request, $postId)
    {
        $this->commentService->createCommentForPost($postId, $request->validated());
        return back()->with('success', 'Comment added successfully.');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully');
    }

}