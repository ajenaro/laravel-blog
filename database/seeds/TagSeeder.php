<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        $tag = new Tag();
        $tag->name = 'Laravel';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Wordpress';
        $tag->save();
    }
}
