<?php


namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Logging\LogsModelChanges;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, LogsModelChanges, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    /**
     * Attributes that should not be logged.
     *
     * @var array<string>
     */
    protected $dontLog = [
        'updated_at'
    ];

    /**
     * Define media collections for the model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('post_images')
             ->singleFile() 
             ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
             ->useDisk('public'); 
    }

    /**
     * Get the post's author.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the post's comments.
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\Comments\Comment::class);
    }

    /**
     * Get the URL of the post's main image.
     */
    public function getImageUrl(): ?string
    {
        return $this->getFirstMediaUrl('post_images');
    }
}