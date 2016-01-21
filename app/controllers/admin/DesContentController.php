<?php

class DesContentController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::action('DesContentController@edit', 1);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.des_content.create');
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
		$viDes = DesContent::find(1);
		$enDes = DesContent::find(2);
		return View::make('admin.des_content.edit')->with(compact('viDes', 'enDes'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$viInput = Input::only('title', 'description');
		DesContent::find(1)->update($viInput);
		$enInput['title'] = Input::get('en_title');
		$enInput['description'] = Input::get('en_description');
		DesContent::find(2)->update($enInput);
		return Redirect::action('DesContentController@edit', 1);
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


}
