@extends('layouts.layout')

@section('meta-title', $post->title)

@section('meta-description', $post->excerpt)

@section('content')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ url('/storage/' . $post->photos->first()->url) }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <h2 class="subheading">
                            {{ $post->excerpt }}
                        </h2>
                        <span class="meta">Posted by
              <a href="#">{{ $post->owner->name }}</a>
              {{ optional($post->published_at)->format('d M, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </article>

@endsection
