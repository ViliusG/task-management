<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function __construct(
        public CategoryRepository $categoryRepository
    ){
    }

    /**
     * @return Collection<Category>
     */
    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function createCategory(string $categoryName): Category
    {
        return $this->categoryRepository->createCategory($categoryName, Auth::id());
    }

    public function updateCategory(Category $category, string $newCategoryName): Category
    {
        return $this->categoryRepository->updateCategory($category, $newCategoryName);
    }
}
