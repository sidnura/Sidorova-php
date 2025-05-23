<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CommentStoreJob implements ShouldQueue
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

    
        $comment = $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id()
        ]);
    
        
    }
}
