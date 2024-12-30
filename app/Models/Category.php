<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)
            ->using(CategoryPost::class)
            ->withPivot(['title']);
    }

    public function publishedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)
            ->where('is_published', 1)
            ->whereDate('updated_at', '<', Carbon::now());
    }
}
