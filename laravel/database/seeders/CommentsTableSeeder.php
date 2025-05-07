<?php

namespace Database\Seeders;

use App\Models\Comments\Comment;
use App\Models\Posts\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Post::all()->each(function ($post) use ($users) {
            Comment::factory()
                ->count(2)
                ->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id
                ]);
        });
    }
}