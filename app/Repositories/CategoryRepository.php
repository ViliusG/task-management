<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * @return Collection<Category>
     */
    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    public function createCategory(string $categoryName, int $userId): Category
    {
        return Category::firstOrCreate([
            'name' => $categoryName,
            'user_id' => $userId,
        ]);
    }

    public function updateCategory(Category $category, string $newCategoryName): Category
    {
        $category->name = $newCategoryName;
        $category->save();

        return $category;
    }
}
