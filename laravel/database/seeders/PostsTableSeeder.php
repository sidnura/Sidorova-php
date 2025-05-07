<?php

namespace Database\Seeders;

use App\Models\Posts\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all() -> each(function ($user){
            Post::factory()
                ->count(2)
                ->create(['user_id' => $user -> id]);
        });
    }
}