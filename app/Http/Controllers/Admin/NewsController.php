<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NewsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Post::orderBy( 'id', 'DESC')->where('post_type', 'news')->with('categories')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = Category::orderBy( 'name', 'ASC' )->pluck( 'name', 'id' );
		return view( 'admin.news.create', compact( 'categories' ) );
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
		{
			$this->validate( $request, [
				"thumbnail" => 'required',
				"title" => 'required|unique:posts',
				"post_content" => "required",
				"category_id" => "required"
			],
				[
					'thumbnail.required' => 'Enter thumbnail url',
					'title.required' => 'Enter title',
					'title.unique' => 'Title already exist',
					'post_content.required' => 'Enter post_content',
					'category_id.required' => 'Select categories',
				]
			);

			$news = new  Post();
			$news->user_id = Auth::id();
			$news->thumbnail = $request->thumbnail;
			$news->title = $request->title;
			$news->slug = str_slug( $request->title );
			$news->short_describe = $request->short_describe;
			$news->position = $request->position;
			$news->post_content = $request->post_content;
			$news->is_published = $request->is_published;
			$news->post_type = 'news';
			$news->save();

			$news->categories()->sync( $request->category_id, false );

			Session::flash( 'message', 'PostItem created successfully' );
			return redirect()->route( 'news.index' );
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $news
     * @return \Illuminate\Http\Response
     */
    public function show(Post $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $news
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $news)
    {
		$categories = Category::orderBy( 'name', 'ASC' )->pluck( 'name', 'id' );
		return view( 'admin.news.edit', compact( 'categories', 'news' ) );
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Post$news
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Post $news)
    {
		$this->validate( $request, [
			"thumbnail" => 'required',
			'title' => 'required|unique:posts,title,' . $news->id . ',id', // ignore this id
			'post_content' => 'required',
			"category_id" => "required"
		],
			[
				'thumbnail.required' => 'Enter thumbnail url',
				'title.required' => 'Enter title',
				'title.unique' => 'Title already exist',
				'post_content.required' => 'Enter post_content',
				'category_id.required' => 'Select categories',
			]
		);

		$news->user_id = Auth::id();
		$news->thumbnail = $request->thumbnail;
		$news->title = $request->title;
		$news->slug = str_slug( $request->title );
		$news->short_describe = $request->short_describe;
		$news->position = $request->position;
		$news->post_content = $request->post_content;
		$news->is_published = $request->is_published;
		$news->save();

		$news->categories()->sync( $request->category_id );

		Session::flash( 'message', 'NEws updated successfully' );
		return redirect()->route( 'news.index' );
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Post$news
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
    public function destroy(Post $news)
    {
		$news->delete();

		Session::flash( 'delete-message', 'PostItem deleted successfully' );
		return redirect()->route( 'news.index' );
    }
}
