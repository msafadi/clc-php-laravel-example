<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    protected $posts = [
        1 => [
            'title' => 'Lorem Ipsum is simply',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem Ipsum has been the and scrambled it. atype specimen',
            'image' => 'assets/images/image01.jpg',
        ],
        [
            'title' => 'Lorem Ipsum is simply 2',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem Ipsum has been the and scrambled it. atype specimen',
            'image' => 'assets/images/image02.jpg',
        ],
        [
            'title' => 'Lorem Ipsum is simply 3',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem Ipsum has been the and scrambled it. atype specimen',
            'image' => 'assets/images/image03.jpg',
        ],
        [
            'title' => 'Lorem Ipsum is simply 4',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem Ipsum has been the and scrambled it. atype specimen',
            'image' => 'assets/images/image04.jpg',
        ],
        [
            'title' => 'Lorem Ipsum is simply 5',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem Ipsum has been the and scrambled it. atype specimen',
            'image' => 'assets/images/image01.jpg',
        ],
        [
            'title' => 'Lorem Ipsum is simply 6',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem Ipsum has been the and scrambled it. atype specimen',
            'image' => 'assets/images/image02.jpg',
        ],
        
    ];

    public function index()
    {
        $data = $this->posts;
        $title = 'My Laravel App';

        return view('home', compact('data', 'title'));
        return view('home')->with(compact('data', 'title'));

        return view('home', [
            'title' => 'My Laravel App',
            'data' => $this->posts,
        ]);
        return view('home')->with([
            'title' => 'My Laravel App',
            'data' => $this->posts,
        ]);
    }

    public function view($id)
    {
        return view('post', [
            'post' => $this->posts[$id],
        ]);
    }
}
