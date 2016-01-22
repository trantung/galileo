<?php

class SiteTypeController extends SiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		dd(123);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		dd(33);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function showSlug($slug)
	{
		$type = TypeNew::findBySlug($slug);
		// dd($type);
		// $lang = LaravelLocalization::setLocale();
		// if ($lang != LANG_EN) {
			$TypeId = $type->id;
		// }
		// else {
		// 	$TypeId = AdminLanguage::where('model_name', 'TypeNew')
		// 		->where('model_id', $type->id)->first()->relate_id;
		// }
		// $viTypeId = TypeNew::findBySlug($slug)->id;
		// $enTypeId = AdminLanguage::where('model_name', 'TypeNew')
		// 	->where('model_id', $viTypeId);
		$inputListNews = AdminNew::where('type_new_id', $TypeId)
			->orderBy('id', 'desc')
			->get();
		// dd($inputListNews);
		return View::make('site.news.listNews')->with(compact('inputListNews', 'slug'));
	}

	public function showChildSlug($slug, $childSlug)
	{
		dd(123);
	}
}
