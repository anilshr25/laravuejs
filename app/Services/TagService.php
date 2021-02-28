<?php

namespace App\Services;

use App\Models\Tag;
use Exception;

class TagService
{

    public function __construct(Tag $tag) {
        $this->tag = $tag;
    }

    public function getTag()
    {
        try {
            return $this->tag::orderBy('id', 'desc')->get();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function store($request)
    {
        try {
            return $this->tag::create([
                'tagName' => $request->tagName
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

    }

    public function update($request)
    {
        try {
            return $this->tag::where('id', $request->id)->update([
                'tagName' => $request->tagName
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

    }

    public function delete($request)
    {
        try {
            return $this->tag::where('id', $request->id)->delete();
        } catch (Exception $ex) {
            throw $ex;
        }

    }
}
