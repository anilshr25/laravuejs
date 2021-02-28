<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService) {
        $this->imageService = $imageService;
    }

    public function uploadImg(Request $request, $uploadFor)
    {
        $this->validate($request, [
            'file'=> 'required| mimes:jpg,jpeg,png'
        ]);
        return $this->imageService->uploadImg($request, $uploadFor);
    }

    public function deleteImg(Request $request)
    {
        return $this->imageService->getDeleteImg($request);
    }
}
