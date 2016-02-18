<?php

class NewsTypeController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$inputNewType = AdminLanguage::where('model_name', 'TypeNew')->orderBy('position', 'asc')->get();
		return View::make('admin.typenew.index')->with(compact('inputNewType'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.typenew.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name'   => 'required',
            // 'en_name' => 'required',
            'position' => 'required|integer|min: 1'
		);
		$input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('NewsTypeController@create')
	            ->withErrors($validator)
	            ->withInput(Input::except('name'));
        } else {
        	$viInput = Input::only('name', 'position');
			$id = CommonNormal::create($viInput);
			$enInput['name'] = Input::get('en_name');
			$enInput['position'] = Input::get('position');
			$enId = CommonNormal::create($enInput);
			$language['model_name'] = 'TypeNew';
			$language['relate_name'] = 'TypeNew';
			$language['model_id'] = $id;
			$language['relate_id'] = $enId;
			$language['status'] = Input::get('status');
			$language['position'] = Input::get('position');
			AdminLanguage::create($language);
			return Redirect::action('NewsTypeController@index');
        }
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
		return View::make('admin.typenew.edit')->with(compact('id'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
            'name'   => 'required',
            // 'en_name' => 'required',
            'position' => 'required|integer|min: 1'
        );
        $input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('NewsTypeController@edit', $id)
	            ->withErrors($validator);
        } else {
        	$inputUpdateMain = Input::only('name', 'position');
        	$relateUpdateId = Common::getValueLanguage('TypeNew', $id, 'relate_id');
        	$inputUpdateRelate['name'] = $input['en_name'];
        	$inputUpdateRelate['position'] = $input['position'];
        	CommonNormal::update($id,$inputUpdateMain);
        	CommonNormal::update($relateUpdateId,$inputUpdateRelate);
        	$inputLanguage = Input::only('position', 'status');
        	AdminLanguage::where('model_name', 'TypeNew')
        		->where('model_id', $id)
        		->where('relate_id', $relateUpdateId)
        		->update($inputLanguage);
			return Redirect::action('NewsTypeController@index');
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$new = AdminNew::where('type_new_id', $id)->first();
		if ($new) {
			AdminNew::where('type_new_id', $id)->delete();
		}
		Common::deleteLanguage($id, 'TypeNew');
		return Redirect::action('NewsTypeController@index');
	}


}
