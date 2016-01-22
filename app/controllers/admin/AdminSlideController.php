<?php

class AdminSlideController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$slides = AdminSlide::orderBy('id', 'desc')->get();
		return View::make('admin.slider.index')->with(compact('slides'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.slider.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::except('_token', 'image_url');
		$slideId = AdminSlide::create($input)->id;
		$inputImg['image_url'] = CommonUpload::uploadImage($slideId, UPLOADIMG, 'image_url',UPLOAD_SLIDE);
		CommonNormal::update($slideId, ['image_url' => $inputImg['image_url']] );
		return Redirect::action('AdminSlideController@index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$slide = AdminSlide::find($id);
		return View::make('admin.slider.edit')->with(compact('slide'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// $input = Input::except('_token', '_method');
		$inputSlide = Input::except('_token', 'image_url');
		CommonNormal::update($id,$inputSlide);
		$imageSlide = AdminSlide::find($id);
		$input['image_url'] = CommonUpload::uploadImage($id, UPLOADIMG, 'image_url',UPLOAD_SLIDE,$imageSlide->image_url);
		CommonNormal::update($id, ['image_url' => $input['image_url']] );

		return Redirect::action('AdminSlideController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		AdminSlide::find($id)->delete();
		return Redirect::action('AdminSlideController@index');
	}

	// public function search()
	// {
	// 	$input = Input::all();
	// 	if (!$input['keyword']) {
	// 		return Redirect::action('AdminSlideController@index');
	// 	}
	// 	$slides = AdminSlide::where('name', 'like', '%'.$input['keyword'].'%')->paginate(PAGINATE_SLIDE);
	// 	// dd($input);
	// 	return View::make('admin.slider.index')->with(compact('slides'));
	// }

}
