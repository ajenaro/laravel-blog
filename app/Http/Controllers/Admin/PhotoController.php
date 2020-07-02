<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Photo;
use App\Post;

class PhotoController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(
            request(),
            [
                'photo' => 'required|image|max:2048'
            ]
        );

        $post->photos()->create(['url' => request()->file('photo')->store('posts', 'public')]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        return back()->with('flash', 'Foto eliminada correctamente');
    }
}
