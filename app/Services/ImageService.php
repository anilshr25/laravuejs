<?php

namespace App\Services;

class ImageService
{
    public function uploadImg($request, $uploadFor)
    {
        if(file_exists($request->file)) {
            $imgName = time(). '.'.$request->file->extension();
            $request->file->move(public_path('uploads/'.$uploadFor), $imgName);
            return $imgName;
        }
    }

    public function getDeleteImg($request)
    {
        $imgName = $request->imageName;
        $this->deleteImg($imgName);
    }

    public function deleteImg($imgName)
    {
        $filePath = public_path().$imgName;
        if(file_exists($filePath)) {
            @unlink($filePath);
        }
        return $imgName;
    }
}
