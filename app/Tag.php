<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(
            Post::class, 
            'posts_tags', 
            'tag_id',
            'post_id',
            'id',
            'id'
        );
    }
}
