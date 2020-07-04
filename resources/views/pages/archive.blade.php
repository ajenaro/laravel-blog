@extends('layouts.layout')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/img/archive-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>Archive</h1>
                        <span class="subheading">Posts Archive</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">

                <h3>Authors</h3>

                <ul class="list-unstyled">
                    @foreach($authors as $author)
                        <li>
                            <a href="{{ route('authors.show', $author) }}">
                                {{ $author->name }} ({{ $author->posts->count() }})
                            </a>
                        </li>
                    @endforeach
                </ul>

                <h3>Categories</h3>

                <ul class="list-unstyled">
                    @foreach($categories as $category)
                        <li class="text-capitalize">
                            <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="col-md-6">

                <h3>Last posts</h3>

                @foreach($posts as $post)
                    <p>
                        <a href="{{ route('posts.show', $post) }}" style="text-decoration: none;">{{ $post->title }}</a>
                    </p>
                @endforeach

                <h3>Post by month</h3>

                <ul class="list-unstyled">
                    @foreach($archive as $date)
                        <li>
                            <a href="{{ route('pages.home', ['month' => $date->month, 'year' => $date->year]) }}">
                                {{ $date->monthname }} {{ $date->year }} ({{ $date->posts }})
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>

        </div>
    </div>

@endsection
