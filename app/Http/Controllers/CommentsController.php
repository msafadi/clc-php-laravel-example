<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //
    public function index($post_id)
    {
        return Post::findOrFail($post_id)->comments;
    }

    public function store(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);
        $user = Auth::user();

        // Save without relation
        /*Comment::create([
            'user_id' => 1,
            'comment' => $request->post('comment'),
            'post_id' => $post->id,
        ]);*/

        $comment = new Comment([
            'user_id' => $user->id,
            'comment' => $request->post('comment'),
        ]);
        //$comment->user_id = 1;
        //$comment->comment = $request->post('comment');

        $post->comments()->save($comment);

        /*$post->comments()->create([
            'user_id' => 1,
            'comment' => $request->post('comment'),
        ]);*/

        // Send Notification
        $post->user->notify(new CommentNotification($post, $user));

        return redirect()->route('post', [$post->slug]);
    }
}
