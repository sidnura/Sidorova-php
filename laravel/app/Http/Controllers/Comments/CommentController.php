<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\Posts\Post;
use App\Models\User; 

use Illuminate\Http\Request;

use App\Models\Comments\Comment; 


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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        // Валидация входных данных
        $validated = $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',  
        ]);
    
        $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => $validated['user_id'],
        ]);
    
        return redirect()->back()->with('success', 'Комментарий добавлен');
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