@extends('layouts.layout')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>{{ config('app.name', 'Laravel') }}</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @forelse($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('posts.show', $post->url) }}">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>
                            <h3 class="post-subtitle">
                                {{ $post->excerpt }}
                            </h3>
                        </a>
                        <p class="post-meta">
                            <a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a> -
                            Posted by
                            <a href="#">{{ $post->owner->name }}</a>
                            {{ optional($post->published_at)->format('d M, Y') }}
                        </p>
                        @include('posts._tags')
                    </div>
                    <hr>
                @empty
                    <div class="post-preview">
                        <h2 class="post-title">You have not published any post yet</h2>
                    </div>
                @endforelse

                @if($posts->count())
                    <!-- Pager -->
                    <div class="clearfix">
                        <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection


