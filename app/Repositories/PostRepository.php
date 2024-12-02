<?php

namespace App\Repositories;
use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * Create a new class instance.
     */
   public function __construct(Post $post)
   {
      parent::__construct($post);
   }

   public function checkPostDate($id, $date)
   {
      // fucntionality goes here
      // e.g Post::checkPostDate($id, $date)
   }

}
