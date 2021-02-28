<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{

    protected $tagService;

    public function __construct(TagService $tagService) {
        $this->tagService = $tagService;
    }

    public function getTag()
    {
        return $this->tagService->getTag();
    }

    public function addTag(Request $request)
    {
        $this->validate($request, [
            'tagName' => 'required'
        ]);
        return $this->tagService->store($request);
    }

    public function editTag(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'tagName' => 'required'
        ]);
        return $this->tagService->update($request);
    }

    public function deleteTag(Request $request)
    {
        return $this->tagService->delete($request);
    }
}
