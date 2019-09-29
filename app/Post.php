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
}
