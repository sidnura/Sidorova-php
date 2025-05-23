<?php

namespace App\Jobs;

use App\Models\Posts\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostStoreJob implements ShouldQueue
{
    use Dispatchable, SerializesModels, InteractsWithQueue, Queueable;

    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $post = Post::create(
            $this->data;
        );

        if (isset($this->data['image'])) {
            $post->addMedia($this->data['image']->getPathname())
                 ->usingFileName($this->data['image']->getClientOriginalName())
                 ->toMediaCollection('posts');
        }
    }
}