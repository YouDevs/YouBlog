<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $newPost = new Post();

        if( $request->hasFile('featured') ) {
            $file = $request->file('featured');
            $destinationPath = 'images/featureds/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('featured')->move($destinationPath, $filename);
            $newPost->featured = $destinationPath . $filename;
        }

        $newPost->title = $request->title;
        $newPost->category_id = $request->category_id;
        $newPost->content = $request->content;
        $newPost->author = $request->author;

        $newPost->save();

        return redirect()->back();
    }

    public function update(Request $request, $postId)
    {
        $post = Post::find($postId);

        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->author = $request->author;
        $post->slug = Str::slug($request->title, '-');

        if( $request->hasFile('featured') ) {
            $file = $request->file('featured');
            $destinationPath = 'images/featureds/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('featured')->move($destinationPath, $filename);
            $post->featured = $destinationPath . $filename;
        }

        $post->save();

       return redirect()->back();
    }

    public function delete(Request $request, $postId)
    {
        $post = Post::find($postId);
        $post->delete();
        return redirect()->back();
    }
}
