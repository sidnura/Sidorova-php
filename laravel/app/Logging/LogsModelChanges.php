<?php

namespace App\Logging;

use Illuminate\Support\Facades\Log;

trait LogsModelChanges
{
    protected static function bootLogsModelChanges()
    {
        static::updated(function ($model) {
            $changes = $model->getChanges();
            $original = $model->getOriginal();
            
            Log::channel('model_changes')->info('Model updated', [
                'model' => get_class($model),
                'id' => $model->id,
                'changes' => $changes,
                'original' => $original,
                'user' => auth()->id(),
                'timestamp' => now(),
            ]);
        });

        static::created(function ($model) {
            Log::channel('model_changes')->info('Model created', [
                'model' => get_class($model),
                'id' => $model->id,
                'attributes' => $model->getAttributes(),
                'user' => auth()->id(),
                'timestamp' => now(),
            ]);
        });

        static::deleted(function ($model) {
            Log::channel('model_changes')->info('Model deleted', [
                'model' => get_class($model),
                'id' => $model->id,
                'attributes' => $model->getAttributes(),
                'user' => auth()->id(),
                'timestamp' => now(),
            ]);
        });
    }
}