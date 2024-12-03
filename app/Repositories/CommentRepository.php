<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }

    // implement here comment model spefic functionality
}
