<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\Posts\Post;
use App\Models\User; 

use Illuminate\Http\Request;

use App\Models\Comments\Comment; 

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request, Post $post)
    {
        if (auth()->user()->hasRole('editor')) {
            return redirect()->back()->with('error', 'Редакторам запрещено оставлять комментарии.');
        }
    
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    
        $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id()
        ]);
    
        return redirect()->back()->with('success', 'Комментарий успешно добавлен.');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}