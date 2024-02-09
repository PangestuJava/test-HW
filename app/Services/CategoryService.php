<?php

namespace App\Services;

use App\Models\Category;

/**
 * Class CategoryService.
 */
class CategoryService extends BaseService
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}
