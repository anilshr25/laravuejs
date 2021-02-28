<?php

namespace App\Services;

use App\Models\Category;
use Exception;

class CategoryService
{
    public function __construct(Category $category, ImageService $imageService) {
        $this->category = $category;
        $this->imageService = $imageService;
    }

    public function getCategory()
    {
        try {
            return $this->category::orderBy('id', 'desc')->get();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function store($request)
    {
        $uploadName = 'category';
        try {
            return $this->category::create([
                'categoryName' => $request->categoryName,
                'iconImg' => $request->iconImg
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

    }

    public function update($request)
    {
        try {
            return $this->category::where('id', $request->id)->update([
                'categoryName' => $request->categoryName,
                'iconImg' => $request->iconImg
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

    }

    public function delete($request)
    {
        try {
            return $this->category::where('id', $request->id)->delete();
        } catch (Exception $ex) {
            throw $ex;
        }

    }
}
