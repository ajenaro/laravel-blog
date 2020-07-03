<?php

namespace App\Http\Controllers;

use App\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        return view('pages.home', [
            'posts' => $tag->posts()->published()->paginate()
        ]);
    }
}
