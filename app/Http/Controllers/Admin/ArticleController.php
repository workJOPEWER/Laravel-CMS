<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$articles = Post::orderBy( 'id', 'DESC' )->where( 'post_type', 'article' )->with('categories')->paginate( 10 );
		return view( 'admin.article.index', compact( 'articles' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create()
	{
		$categories = Category::orderBy( 'name', 'ASC' )->pluck( 'name', 'id' );
		return view( 'admin.article.create', compact( 'categories' ) );
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
					'post_content.required' => 'Enter details',
					'category_id.required' => 'Select categories',
				]
			);

			$article = new Post();
			$article->user_id = Auth::id();
			$article->thumbnail = $request->thumbnail;
			$article->title = $request->title;
			$article->slug = str_slug( $request->title );
			$article->position = $request->position;
			$article->short_describe = $request->short_describe;
			$article->post_content = $request->post_content;
			$article->is_published = $request->is_published;
			$article->post_type = 'article';
			$article->save();


			$article->categories()->sync($request->category_id, false);

			Session::flash( 'message', 'Article created successfully' );
			return redirect()->route( 'articles.index' );
		}

	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Post $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $article)
    {
		$categories = Category::orderBy( 'name', 'ASC' )->pluck( 'name', 'id' );
		return view( 'admin.article.edit', compact( 'categories', 'article' ) );
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param Post $article
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Post $article)
	{
		$this->validate( $request, [
			"thumbnail" => 'required',
			'title' => 'required|unique:posts,title,' . $article->id . ',id', // ignore this id
			'post_content' => 'required',
			"category_id" => "required"
		],
			[
				'thumbnail.required' => 'Enter thumbnail url',
				'title.required' => 'Enter title',
				'title.unique' => 'Title already exist',
				'short_describe.required' => 'Enter details',
				'category_id.required' => 'Select categories',
			]
		);

		$article->user_id = Auth::id();
		$article->thumbnail = $request->thumbnail;
		$article->title = $request->title;
		$article->slug = str_slug( $request->title );
		$article->short_describe = $request->short_describe;
		$article->position = $request->position;
		$article->post_content = $request->post_content;
		$article->is_published = $request->is_published;
		$article->save();

		$article->categories()->sync( $request->category_id );

		Session::flash( 'message', 'Article updated successfully' );
		return redirect()->route( 'articles.index' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Post $article
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
    public function destroy(Post $article)
	{
		$article->delete();

		Session::flash( 'delete-message', 'Article deleted successfully' );
		return redirect()->route( 'articles.index' );
	}

}
