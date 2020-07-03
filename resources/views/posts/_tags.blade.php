<div>
    @foreach($post->tags as $tag)
        <span><a href="{{ route('tags.show', $tag) }}">#{{ $tag->name }}</a></span>
    @endforeach
</div>
