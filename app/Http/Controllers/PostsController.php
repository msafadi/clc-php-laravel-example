<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index()
    {
        return view('home')->with([
            'title' => 'My Laravel App',
            'posts' => Post::all(),
        ]);
    }

    public function view($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }

        return view('post', [
            'post' => $post,
        ]);
    }
}
