<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends BaseController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$categories = Category::orderByDesc( 'name' )->get();

		return response()->json( $categories );
	}

	/**
	 *
	 * @param $slug
	 * @return \Illuminate\Http\JsonResponse
	 */

	public function showPosts($slug)
	{
		$category = Category::where( 'slug', $slug )->first();
		$posts = $category->posts()->orderBy( 'posts.id', 'DESC' )->where( 'is_published', '1' )->with( 'categories' )->paginate( 5 );

		return response()->json( $posts );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$category = Category::create( array_merge( $request->all(), ['slug' => str_slug( $request->name )] ) );

		return response()->json( $category );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $slug
	 * @param $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug, $id)
	{
		$category = Category::where( 'slug', $slug )->first();
		$categoryPost = $category->posts()->findOrFail( $id );

		return response()->json( $categoryPost );
	}

	/**
	 * @param $ids
	 * @return
	 */

	public function getCategoriesIds($ids)
	{
		$category = Category::whereIn( 'id', $ids )->orderBy( 'position')
			->with( ['posts' => function ($q) {
				$q->orderBy( 'position');
			}] )->get();

		return $category;
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function showAboutPage()
	{
		$ids = [25, 26, 27];
		$categoryAboutPage = $this->getCategoriesIds( $ids );

		return response()->json( $categoryAboutPage );

	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function showInfoPage()
	{
		$ids = [28, 29, 30, 31];
		$categoryInfoPage = $this->getCategoriesIds( $ids );

		return response()->json( $categoryInfoPage );
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function showNewsPage()
	{
		$ids = [32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43];
		$categoryNewsPage = $this->getCategoriesIds( $ids );

		return response()->json( $categoryNewsPage );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param $id
	 * @return void
	 */
	public function update(Request $request, $id)
	{	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id
	 * @return void
	 */
	public function destroy($id)
	{	}

}
