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
		$typeName = $type->name;

		$data = Common::getNews($type->id, getLang());

		return View::make('site.news.listNews')->with(compact('data', 'typeName', 'slug'));
	}

	public function showChildSlug($slug, $childSlug)
	{
		$type = TypeNew::findBySlug($slug);
		$typeName = $type->name;

		$data = AdminNew::findBySlug($childSlug);

		$related = AdminNew::where('type_new_id', $data->type_new_id)
								->whereNotIn('id', [$data->id])
								->orderBy('id', 'desc')
								->limit(PAGINATE_RELATED)
								->get();

		return View::make('site.news.showNews')->with(compact('data', 'related', 'typeName', 'slug'));
	}
}
