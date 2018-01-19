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
		$group = PermissionGroup::find($id);
		// $methods = get_class_methods ('SubjectController');
		// dd($methods);

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
		$permission = $input['permission'];
		$controllerName = array_keys($permission)[0];
		$modelName = Common::getModelNameByController($controllerName);
		$inputPer['controller'] = array_keys($permission)[0];
		$inputPer['model'] = $modelName;
		$inputPer['group_id'] = $id;
		$group = PermissionGroup::find($id);
		Permission::where('group_id', $id)->delete();
		if ($group->code == THL) {
			foreach (Common::getMethodLevel() as $key => $value) {
				Permission::create([
					'controller' => 'LevelController',
					'group_id' => $id,
					'model_name' => 'Level',
					'action' => $value,
				]);
			}
		}
		foreach ($permission as $key => $value) {
			foreach (array_keys($value) as $k => $v) {
				$inputPer['action'] = $v;
				Permission::create($inputPer);
			}
		}
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
