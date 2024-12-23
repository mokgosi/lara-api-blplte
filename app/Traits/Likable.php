<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Likable
{
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function like(bool $like = true, User $user = null): void 
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id
        ], [
            'is_liked' => $like
        ]);
    }

    public function dislike(User $user = null)
    {
        return $this->like(false, $user);
    }

    public function isLikedBy(User $user)
    {
        return $user->likes
            ->where('post_id', $this->id)
            ->where('is_liked', true)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        return $user->likes
            ->where('post_id', $this->id)
            ->where('is_liked', false)
            ->count();
    }
}
