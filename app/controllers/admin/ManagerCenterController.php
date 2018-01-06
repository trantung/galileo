<?php
class ManagerCenterController extends AdminController implements AdminInterface{
    public function __construct() {
        // $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$centers = Center::all();	
        return View::make('admin.center.index')->with(compact('centers'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$listPartners = Partner::lists('name', 'id');
		return View::make('admin.center.create')->with(compact('listPartners'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::except('_token');
		dd($input);
		
		$centerId = Center::create($input)->id;
		return Redirect::action('ManagerCenterController@index');
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
		$center = Center::find($id);
		$partnerId = $center->partner_id;
		$listPartners = Partner::lists('name', 'id');
		return View::make('admin.center.edit')->with(compact('center', 'partnerId', 'listPartners'));
    }
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::except('_token', '_method');
		$center = Center::find($id);
		$center->update($input);
		return Redirect::action('ManagerCenterController@index');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Partner::find($id)->delete();
		return Redirect::action('ManagerCenterController@index');
	}
	public function getResetPass($id)
	{
		return View::make('admin.center.reset_password')->with(compact('id'));
	}
	public function postResetPass($id)
	{
		$input = Input::all();
		$partner = Partner::find($id);
		$password = Hash::make($input['password']);
		$partner->update(['pass' => $password]);
		return Redirect::action('ManagerCenterController@index');

	}

}
