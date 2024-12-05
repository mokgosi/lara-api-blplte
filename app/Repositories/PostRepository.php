<?php

namespace App\Repositories;
use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
   protected $model;
    /**
     * Create a new class instance.
     */
   public function __construct(Post $post)
   {
      parent::__construct($post);

      $this->model = $post;
   }

   /**
     * Example implementation of functionality specific to Post.
     */
   public function checkPostDate($id, $date)
   {
      // fucntionality goes here 
      // e.g Post::checkPostDate($id, $date)
   }

   public function getPostWithComments($id)
   {
      $feeds = $this->model::with('user','comments')
               ->withCount('comments')
               ->where('id', $id)
               ->get();

      return $feeds;
   }
}
