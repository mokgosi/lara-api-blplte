<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    // implement Category specific functionality
}
