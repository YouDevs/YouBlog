<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderBy('id', 'DESC')->paginate(3);
        return view('posts', [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    public function post($post)
    {
        // Obtener post
        $post = Post::where('slug', '=' , $post)->first();
        $latestPosts = Post::orderBy('id', 'DESC')->take(3)->get();
        return view('post', [
            'post' => $post,
            'latestPosts' => $latestPosts
        ]);
    }

    public function postsByCategory($category)
    {
        $categories = Category::all();
        $category = Category::where('slug', '=' ,$category)->first();
        $categoryIdSelected = $category->id;
        $posts = Post::where('category_id', '=', $categoryIdSelected)->paginate(3);
        return view('posts', [
            'categories' => $categories,
            'posts' => $posts,
            'categoryIdSelected' => $categoryIdSelected
        ]);
    }
}
