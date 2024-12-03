<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, HasApiTokens;

    protected $fillable = ['title', 'body', 'user_id', 'slug'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
