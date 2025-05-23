<?php

namespace App\Services\Comments;

use App\Jobs\CommentStoreJob;

class CommentService
{
    public function create(array $data)
    {    
        CommentStoreJob::dispatch($data);
    }

}