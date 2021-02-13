<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory()
    {
        return Category::orderBy('id', 'desc')->get();
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImg' => 'required'
        ]);
        return Category::create([
            'categoryName' => $request->categoryName,
            'iconImg' => $request->iconImg
        ]);
    }

    public function editCategory(Request $request)
    {
        $this->validate($request, [
            'categoryName' => 'required',
            'iconImg' => 'required'
        ]);
        return Category::where('id', $request->id)->update([
            'categoryName' => $request->categoryName,
            'iconImg' => $request->iconImg
        ]);
    }

    public function uploadImg(Request $request)
    {
        $this->validate($request, [
            'file'=> 'required| mimes:jpg,jpeg,png'
        ]);
        if(file_exists($request->file)) {
            $imgName = time(). '.'.$request->file->extension();
            $request->file->move(public_path('uploads/category'), $imgName);
            return $imgName;
        }
    }

    public function getDeleteImg(Request $request)
    {
        $imgName = $request->imageName;
        $this->deleteImg($imgName);
    }

    public function deleteImg($imgName)
    {
        $filePath = public_path().'/'.$imgName;
        if(file_exists($filePath)) {
            @unlink($filePath);
        }
        return $imgName;
    }

    public function deleteCategory(Request $request)
    {
        $this->deleteImg($request->iconImg);
        return Category::where('id', $request->id)->delete();
    }
}
