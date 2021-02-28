<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function getCategory()
    {
        return $this->categoryService->getCategory();
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImg' => 'required',
        ]);
        return $this->categoryService->store($request);
    }

    public function editCategory(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'categoryName' => 'required',
            'iconImg' => 'required',
        ]);
        return $this->categoryService->update($request);
    }

    public function deleteCategory(Request $request)
    {
        return $this->categoryService->delete($request);
    }
}
