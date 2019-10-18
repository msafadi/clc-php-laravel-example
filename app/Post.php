<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //
    //protected $fillable = ['title', 'content', 'slug', 'status', 'category_id', 'image'];

    protected $guarded = ['id'];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault([
            'name' => 'Ucategorized',
        ]);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'name' => 'Anonymous',
            'email' => 'sample@example.com'
        ]);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'posts_tags',
            'post_id',
            'tag_id',
            'id',
            'id'
        );
    }

    /*public function comments()
    {
        return $this->hasMany(Comment::class);
    }*/

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function postsWithCategoryName()
    {
        return Post::join('categories', 'categories.id', '=', 'posts.category_id')
            ->select(['posts.*', 'categories.name as category_name'])
            ->get();
    }
}
