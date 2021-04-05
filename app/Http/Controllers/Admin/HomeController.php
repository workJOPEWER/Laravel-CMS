<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\Information;
use App\Models\News;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
	   # die('asd');
		$categories = Category::orderBy('id', 'DESC')->limit('3')->get();
		$articles = Post::orderBy('id', 'DESC')->where('post_type', 'articles')->limit('3')->get();
		$posts = Post::orderBy('id', 'DESC')->where('post_type', 'post')->limit('3')->get();
		$news = Post::orderBy('id', 'DESC')->where('post_type', 'news')->limit('3')->get();
		$information = Post::orderBy('id', 'DESC')->where('post_type', 'information')->limit('3')->get();
		return view('admin.index', compact('categories',  'articles', 'news', 'information', 'posts'));
    }
}
