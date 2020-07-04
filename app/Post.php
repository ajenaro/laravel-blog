<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'iframe',
        'body',
        'published_at',
        'category_id'
    ];

    protected $dates = ['published_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($post) {
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    /*
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['url'] = Str::slug($title, '-');
    }
    */

    public function setPublishedAtAttribute( $published_at )
    {
        $this->attributes['published_at'] = $published_at
                                            ? Carbon::createFromFormat('d/m/Y', $published_at)->format('Y-m-d')
                                            : null;
    }

    public function setCategoryIdAttribute($category_id)
    {
        $this->attributes['category_id'] = Category::find($category_id)
                                            ? $category_id
                                            : Category::create(['name' => $category_id])->id;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public static function create(array $attributes = [])
    {
        $post = static::query()->create($attributes);

        $post->generateUrl();

        return $post;
    }

    public function generateUrl()
    {
        $url = Str::slug($this->title, '-');

        if($this::where('url', $url)->exists())
        {
            $url = "{$url}-{$this->id}";
        }

        $this->url = $url;

        $this->save();
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now())
            ->latest('published_at');
    }

    public function scopeByYearAndMonth($query)
    {
        return $query->selectRaw('year(published_at) year')
            ->selectRaw('month(published_at) month')
            ->selectRaw('monthname(published_at) monthname')
            ->selectRaw('count(*) posts')
            ->groupBy('year', 'month', 'monthname')
            ->orderBy('published_at', 'DESC');
    }

    public function isPublished()
    {
        return !is_null( $this->published_at ) && $this->published_at <= today();
    }

    public function synTags($tags)
    {
        $tagIds = collect($tags)->map(function ($tag) {
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }
}
