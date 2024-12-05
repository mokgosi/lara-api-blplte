<?php

namespace App\Repositories;

use App\Interfaces\LikeRepositoryInterface;
use App\Models\Like;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Like $like)
    {
        parent::__construct($like);
    }

    // implement Like specific methods
}
