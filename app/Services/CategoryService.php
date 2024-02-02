<?php

namespace App\Services;

use App\Models\Category;

/**
 * Class CategoryService.
 */
class CategoryService
{
    public function getAllCategory()
    {
        return Category::get();
    }

    public function createCategory(array $data)
    {
        return Category::create([
            'name' => $data['name'],
        ]);
    }

    public function getCategoryByUuid($uuid)
    {
        return Category::where('uuid', $uuid)->first();
    }

    public function updateCategory($uuid, array $data)
    {
        $category = $this->getCategoryByUuid($uuid);
        $category->update([
            'name' => $data['name'],
        ]);
    }

    public function deleteCategory($uuid)
    {
        $category = $this->getCategoryByUuid($uuid);
        $category->delete();
    }
}
