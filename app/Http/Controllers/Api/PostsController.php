<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Post::with(['category', 'user'])->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:255|min:10',
            'content' => 'required|string',
            'category_id' => 'required|int',
            'status' => 'required|in:draft,published',
            'image' => 'image',
            'tag_id' => 'array',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
        }

        $title = $request->input('title');
        $slug = strtolower(preg_replace('#\s+#', '-', $title));
        $post = Post::create([
            'title' => $title,
            'content' => $request->input('content'),
            'slug' => $slug,
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'image' => $image,
            'user_id' => 1,
        ]);

        $post->tags()->sync($request->input('tag_id'));

        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'error' => 'Post not found',
            ], 404);
        }
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required|max:255|min:10',
            'content' => 'required|string',
            'category_id' => 'required|int',
            'status' => 'required|in:draft,published',
            'image' => 'image',
            'tag_id' => 'array',
        ]);

        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'error' => 'Post not found',
            ], 404);
        }

        //$this->authorize('update', $post);

        $image = $post->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            if ($image) {
                Storage::disk('public')->delete($post->image);
            }
        }
        
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'image' => $image,
        ]);

        $post->tags()->sync($request->input('tag_id'));
        
        return response()->json([
            'message' => 'Updated',
            'data' => $post,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'error' => 'Post not found',
            ], 404);
        }

        $post->delete();

        return response()->json([
            'message' => 'Deleted',
            'data' => $post,
        ]);
    }
}
