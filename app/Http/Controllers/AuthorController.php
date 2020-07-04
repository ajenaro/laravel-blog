<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(User $author)
    {
        return view('pages.home', [
            'posts' => $author->posts()->published()->paginate()
        ]);
    }
}
