<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;

class PagesController extends Controller
{
    public function home()
    {
        $query = Post::published();

        if(request('month')) {
            $query->whereMonth('published_at', request('month'));
        }

        if(request('year')) {
            $query->whereYear('published_at', request('year'));
        }

        $posts = $query->paginate();

        return view('pages.home', compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        $archive = Post::published()->byYearAndMonth()->get();

        return view('pages.archive', [
            'authors' => User::with('posts')->has('posts')->get(),
            'categories' => Category::take(5)->get(),
            'posts' => Post::latest('published_at')->take(5)->get(),
            'archive' => $archive
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
