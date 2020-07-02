<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view('admin.posts.edit', [
            'categories' => $categories,
            'tags'      => $tags,
            'post'      => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
        ]);

        $post = Post::create($request->only('title'));

        $post->save();

        return redirect()->route('admin.posts.edit', $post);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->except('tags'));

        $post->synTags($request['tags']);

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('flash', 'Tu publicación ha sido guardada correctamente');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('flash', 'Tu publicación ha sido eliminada correctamente');
    }
}
