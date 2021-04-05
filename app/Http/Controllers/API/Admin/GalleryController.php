<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$galleries = Gallery::orderBy('id', 'DESC')->paginate(10);
		return response()->json( $galleries );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		foreach ($request->image_url as $image_url) {
			// Get file name with extension
			$fileNameWithExt = $image_url->getClientOriginalName();

			// Get just file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

			// Get just file extension
			$fileExt = $image_url->getClientOriginalExtension();

			// Get file name to store
			$fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

			$gallery = new Gallery();
			$gallery->user_id = Auth::id();
			$gallery->image_url = $fileNameToStore;
			$save = $gallery->save();

			if ($save) {
				$image_url->storeAs('public/galleries', $fileNameToStore);
			}
		}

		/** @var TYPE_NAME $gallery */
		return response()->json( $gallery );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$gallery = Gallery::findOrFail( $id );
		return response()->json( $gallery );

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
    }
}
