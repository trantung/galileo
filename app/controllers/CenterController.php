<?php

class CenterController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Center::all(); //Lấy tất cả dữ liệu trong bảng Order
		//Hiển thị dữ liệu ra view tất cả dữ liệu được lấy từ bảng Order 
		//dd($data);
		return View::make('center.index')->with(compact('data'));

	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$partner = Partner::lists('partner_name','id');
		//$partner = Partner::select('partner_name','id')->get();
		return View::make('center.create')->with(compact('partner'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$centerId = Center::create($input)->id;
		return Redirect::action('CenterController@index');

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
		$center = Center::findOrFail($id);
		$partner = Partner::lists('partner_name','id');
		return View::make('center.edit')->with(compact('partner','center'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::except('_token');
		Center::findOrFail('id')->update($input);
		return Redirect::acction('CenterController@index');
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
