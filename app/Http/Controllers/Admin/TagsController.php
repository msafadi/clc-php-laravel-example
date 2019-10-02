<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;

class TagsController extends Controller
{
    //
    public function posts($id)
    {
        $tag = Tag::findOrFail($id);

        /*return Post::join('posts_tags', 'posts_tags.post_id', '=', 'posts.id')
            ->where('posts_tags.tag_id', $id)
            ->get();*/

        return $tag->posts;
        //return $tag->posts->where('status', 'published')->get();
    }
}
