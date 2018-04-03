<?php

class QuantityDownloadController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = QuantityDownload::all();
		return View::make('admin.download.index')->with(compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$class = ClassModel::lists('name', 'id');
        $subject = Subject::lists('name', 'id');
        $level = Level::lists('name', 'id');
		return View::make('admin.download.create')->with(compact('class', 'subject', 'level'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$input['start_time'] = date('Y-m-d', strtotime(Input::get('start_time')));
		$input['end_time'] = date('Y-m-d', strtotime(Input::get('end_time')));
		$downloaId = QuantityDownload::create($input)->id;
		return Redirect::action('QuantityDownloadController@edit');
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
		$download = QuantityDownload::all();
		return View::make('admin.download.edit')->with(compact('download'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		QuantityDownload::findOrFail($id)->update($input);
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
