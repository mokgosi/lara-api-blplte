<?php

namespace App\Interfaces;

interface PostRepositoryInterface extends BaseInterface
{
    /**
     * Add any other functionality specific to Post
     * @example checkPostDate
     */

    public function checkPostDate($id, $date);
    public function getPostWithComments($id);
}
