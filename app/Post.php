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
        return $this->belongsTo(Category::class, 'category_id', 'id');
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

    public static function postsWithCategoryName()
    {
        return Post::join('categories', 'categories.id', '=', 'posts.category_id')
            ->select(['posts.*', 'categories.name as category_name'])
            ->get();
    }
}
