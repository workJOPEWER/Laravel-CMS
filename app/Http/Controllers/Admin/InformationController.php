<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Information;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InformationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information = Post::orderBy('id', 'DESC')->where('post_type', 'information')->with('categories')->paginate(10);
        return view('admin.information.index', compact('information'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
	{
		$categories = Category::orderBy( 'name', 'ASC' )->pluck( 'name', 'id' );
		return view( 'admin.information.create', compact( 'categories' ) );
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

			$information = new  Post();
			$information->user_id = Auth::id();
			$information->thumbnail = $request->thumbnail;
			$information->title = $request->title;
			$information->slug = str_slug( $request->title );
			$information->short_describe = $request->short_describe;
			$information->position = $request->position;
			$information->post_content = $request->post_content;
			$information->is_published = $request->is_published;
			$information->post_type = 'information';
			$information->save();

			$information->categories()->sync( $request->category_id, false );

			Session::flash( 'message', 'Info articles created successfully' );
			return redirect()->route( 'information.index' );
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $information
     * @return \Illuminate\Http\Response
     */
    public function show(Post $information)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $information
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $information)
    {
		$categories = Category::orderBy( 'name', 'ASC' )->pluck( 'name', 'id' );
		return view( 'admin.information.edit', compact( 'categories', 'information' ) );
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Post $information
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Post $information)
    {
		$this->validate( $request, [
			"thumbnail" => 'required',
			'title' => 'required|unique:posts,title,' . $information->id . ',id', // ignore this id
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

		$information->user_id = Auth::id();
		$information->thumbnail = $request->thumbnail;
		$information->title = $request->title;
		$information->slug = str_slug( $request->title );
		$information->short_describe = $request->short_describe;
		$information->position = $request->position;
		$information->post_content = $request->post_content;
		$information->is_published = $request->is_published;
		$information->save();

		$information->categories()->sync( $request->category_id );

		Session::flash( 'message', 'Info articles updated successfully' );
		return redirect()->route( 'information.index' );
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Post $information
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
    public function destroy(Post $information)
    {
		$information->delete();

		Session::flash( 'delete-message', 'Info articles deleted successfully' );
		return redirect()->route( 'information.index' );
    }
}
