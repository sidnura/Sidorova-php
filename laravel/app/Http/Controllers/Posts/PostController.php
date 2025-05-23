<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Http\Requests\Comments\StoreCommentRequest;
use App\Services\Posts\PostService;
use App\Models\Posts\Post;

use Illuminate\Support\Facades\Mail;
use App\Mail\PostPublishedMail;
use App\Models\User;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;

        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:posts.create')->only(['create', 'store']);
        $this->middleware('can:posts.edit')->only(['edit', 'update']);
        $this->middleware('can:posts.delete')->only(['destroy']);
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('post_images');
        }
        
        $users = User::all(); 
        foreach ($users as $user) {
            Mail::to($user->email)->send(new PostPublishedMail($post));
        }

        return redirect()->route('posts.show', $post)->with('success', 'Пост успешно создан');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (!(auth()->user()->hasRole('admin') || auth()->user()->hasRole('editor') || auth()->id() === $post->user_id)) {
            abort(403, 'У вас нет прав на редактирование');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        if (!auth()->user()->hasRole('admin') && auth()->id() !== $post->user_id) {
            abort(403, 'У вас нет прав на редактирование этого поста');
        }

        try {
            $post->update([
                'title' => $request->title,
                'content' => $request->content
            ]);

            if ($request->hasFile('image')) {
                $post->clearMediaCollection('post_images');
                $post->addMediaFromRequest('image')->toMediaCollection('post_images');
            }

            return redirect()->route('posts.show', $post)->with('success', 'Пост успешно обновлён');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ошибка при обновлении: ' . $e->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        if (!auth()->user()->hasRole('admin') && auth()->id() !== $post->user_id) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост удалён');
    }

    public function storeComment(StoreCommentRequest $request, Post $post)
    {
        $this->authorize('create-comment', $post);

        $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Комментарий добавлен');
    }
}
