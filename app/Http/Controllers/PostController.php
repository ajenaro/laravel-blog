<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        if($post->isPublished() || auth()->check())
        {
            return view('posts.show', [
                'post' => $post
            ]);
        }

        abort(404);
    }
}
