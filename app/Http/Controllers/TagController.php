<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function getTag()
    {
        return Tag::orderBy('id', 'desc')->get();
    }

    public function addTag(Request $request)
    {
        $this->validate($request, [
            'tagName' => 'required'
        ]);
        return Tag::create([
            'tagName' => $request->tagName
        ]);
    }

    public function updateTag(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'tagName' => 'required'
        ]);
        return Tag::where('id', $request->id)->update([
            'tagName' => $request->tagName
        ]);
    }

    public function deleteTag(Request $request)
    {
        return Tag::where('id', $request->id)->delete();
    }
}
