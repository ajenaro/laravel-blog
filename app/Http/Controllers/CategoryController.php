<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return view('pages.home', [
            'posts' => $category->posts()->published()->paginate()
        ]);
    }
}
