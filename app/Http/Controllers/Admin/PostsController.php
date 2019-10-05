<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    //
    public function index()
    {
        //$posts = Post::postsWithCategoryName();
        //return $posts;

        return view('admin.posts.index', [
            //'posts' => DB::table('posts')->get(),
            'posts' => Post::with('category')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
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
        //DB::table('posts')->insert([
        $post = Post::create([
            'title' => $title,
            'content' => $request->input('content'),
            'slug' => $slug,
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'image' => $image,
            //'created_at' => now(),
            //'updated_at' => now(),
        ]);

        $post->tags()->sync($request->input('tag_id'));

        /*$post = Post::create($request->except([
            'tag_id', '_token'
        ]));*/

        // Another Method
        /*$post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = '';
        $post->save();*/

        //return redirect(route('posts.index'))->with('message', 'Post created successfully!');
        $message = sprintf('Post "%s" created successfully!', $post->title);
        return redirect()->route('posts.index')->with('message', $message);
    }

    public function edit($id)
    {
        //$post = DB::table('posts')->where('id', '=', $id)->first();
        //$post = Post::where('id', $id)->first();
        $post = Post::findOrFail($id);
        /*$post = Post::find($id);
        if (!$post) {
            abort(404);
        }*/

        return view('admin.posts.edit', [
            'post' => $post,
            'post_tags' => $post->tags->pluck('id')->toArray(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255|min:10',
            'content' => 'required|string',
            'category_id' => 'required|int',
            'status' => 'required|in:draft,published',
            'image' => 'image',
            'tag_id' => 'array',
        ]);

        $post = Post::findOrFail($id);

        $image = $post->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            if ($image) {
                Storage::disk('public')->delete($post->image);
            }
        }
        
        //DB::table('posts')->where('id', $id)
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'image' => $image,
            //'updated_at' => now(),
        ]);

        $post->tags()->sync($request->input('tag_id'));

        /*DB::table('posts_tags')->where('post_id', $post->id)->delete();
        if ($request->has('tag_id')) {
            foreach ($request->input('tag_id') as $tag_id) {
                DB::table('posts_tags')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $tag_id,
                ]);
            }
        }*/

        // Another Method
        //Post::where('id', $id)->update($request->all());

        $message = sprintf('Post "%s" updated successfully!', $post->title);
        return redirect()->route('posts.index')->with('message', $message);
    }

    public function destroy($id)
    {
        //Post::where('id', $id)->delete();

        // Another Method
        $post = Post::findOrFail($id);
        $post->delete();

        $message = sprintf('Post "%s" deleted successfully!', $post->title);
        return redirect()->route('posts.index')->with('message', $message);
                                               //->with('error', 'Some error occured!');

        
    }

    public function trash()
    {
        return view('admin.posts.trash', [
            'posts' => Post::onlyTrashed()->get(),
        ]);
    }

    public function restore(Request $request, $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        $message = sprintf('Post "%s" restored successfully!', $post->title);
        return redirect()->route('posts.trash')->with('message', $message);
                                               //->with('error', 'Some error occured!');

    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        $post->forceDelete();
        Storage::disk('public')->delete($post->image);

        $message = sprintf('Post "%s" Deleted successfully!', $post->title);
        return redirect()->route('posts.trash')->with('message', $message);
                                               //->with('error', 'Some error occured!');

    }

    public function tags($id)
    {
        $post = Post::findOrFail($id);

        return $post->tags;
    }
}
