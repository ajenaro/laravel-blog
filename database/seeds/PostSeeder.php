<?php

use App\Photo;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');
        Photo::truncate();
        Post::truncate();

        factory(Post::class)->times(5)->create();

        $tags = Tag::all();

        Post::all()->each(function ($post) use ($tags) {
            $post->tags()->sync($tags->random(
                rand(1, 2)
            )->pluck('id')->toArray());
        });
    }
}
