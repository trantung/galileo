<?php

class PermissionGroupController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = PermissionGroup::all();
		return View::make('admin.permission.group.index')->with(compact('groups'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.permission.group.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::except('_token');
		$input['status'] = 1;
		PermissionGroup::create($input)->id;
		return Redirect::action('PermissionGroupController@index');
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
		$group = PermissionGroup::findOrFail($id);
		return View::make('admin.permission.group.edit')->with(compact('group'));
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
		$levelPerId = [];
		$group = PermissionGroup::find($id);
		$group->update(Input::only(['name', 'code']));
		$permission = $input['permission'];
		$controllerName = array_keys($permission)[0];
		$listPerId = Permission::where('controller', $controllerName)
			->whereIn('action', array_keys($permission[$controllerName]))
			->lists('id');
		if ($group->code == THL) {
			$levelPerId = Permission::where('controller', 'LevelController')
				->lists('id');
		}
		$listPerId = array_merge($listPerId, $levelPerId);
		$group->permissions()->sync($listPerId);
		return Redirect::action('PermissionGroupController@index');
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
