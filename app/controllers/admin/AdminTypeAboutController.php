<?php

class AdminTypeAboutController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$typeAboutUs = AdminLanguage::where('model_name', 'TypeAboutUs')->orderBy('position', 'asc')->get();
		return View::make('admin.typeabout.index')->with(compact('typeAboutUs'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.typeabout.create');
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
			// 'name_shadow'   => 'required',
			// 'en_name'   => 'required',
			// 'en_name_shadow'   => 'required',
			'position' => 'required|integer|min: 1'
		);
		$input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('AdminTypeAboutController@create')
	            ->withErrors($validator)
	            ->withInput(Input::except('name'));
        } else {
        	$viInput = Input::only('name', 'name_shadow', 'position');
        	$viInput['sort'] = Input::get('status');
			$id = CommonNormal::create($viInput);
			$enInput['name'] = Input::get('en_name');
			$enInput['name_shadow'] = Input::get('en_name_shadow');
			$enInput['position'] = Input::get('position');
			$enInput['sort'] = Input::get('status');
			$enId = CommonNormal::create($enInput);
			$language['model_name'] = 'TypeAboutUs';
			$language['relate_name'] = 'TypeAboutUs';
			$language['model_id'] = $id;
			$language['relate_id'] = $enId;
			$language['position'] = Input::get('position');
			$language['status'] = Input::get('status');
			AdminLanguage::create($language);
			return Redirect::action('AdminTypeAboutController@index');
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
		return View::make('admin.typeabout.edit')->with(compact('id'));
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
			// 'name_shadow'   => 'required',
			// 'en_name'   => 'required',
			// 'en_name_shadow'   => 'required',
			'position' => 'required|integer|min: 1'
        );
        $input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('AdminTypeAboutController@edit', $id)
	            ->withErrors($validator);
        } else {
        	$inputUpdateMain = Input::only('name', 'name_shadow', 'position');
        	$inputUpdateMain['sort'] = Input::get('status');
        	$relateUpdateId = Common::getValueLanguage('TypeAboutUs', $id, 'relate_id');
        	$inputUpdateRelate['name'] = $input['en_name'];
        	$inputUpdateRelate['name_shadow'] = $input['en_name_shadow'];
        	$inputUpdateRelate['position'] = $input['position'];
        	$inputUpdateRelate['sort'] = $input['status'];
        	CommonNormal::update($id,$inputUpdateMain);
        	CommonNormal::update($relateUpdateId,$inputUpdateRelate);
        	$inputLanguage = Input::only('position', 'status');
        	AdminLanguage::where('model_name', 'TypeAboutUs')
        		->where('model_id', $id)
        		->where('relate_id', $relateUpdateId)
        		->update($inputLanguage);
			return Redirect::action('AdminTypeAboutController@index');
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
		$about = AboutUs::where('type_id', $id)->first();
		if ($about) {
			AboutUs::where('type_id', $id)->delete();
		}
		Common::deleteLanguage($id, 'TypeAboutUs');
		return Redirect::action('AdminTypeAboutController@index');
	}


}
