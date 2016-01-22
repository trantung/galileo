<?php

class AdminIntroduceController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$introduces = AdminLanguage::where('model_name', 'Introduce')->orderBy('position', 'asc')->get();
		return View::make('admin.introduce.index')->with(compact('introduces'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.introduce.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$viInput['title'] = $input['title'];
		$viInput['description'] = $input['description'];
		$viInput['css'] = $input['css'];
		$viInput['position'] = $input['position'];
		$idVi = CommonNormal::create($viInput);

		$enInput['title'] = $input['en_title'];
		$enInput['description'] = $input['en_description'];
		$enInput['css'] = $input['css'];
		$enInput['position'] = $input['position'];
		$idEn = CommonNormal::create($enInput);

		$language['model_name'] = 'Introduce';
		$language['relate_name'] = 'Introduce';
		$language['model_id'] = $idVi;
		$language['relate_id'] = $idEn;
		$language['position'] = $input['position'];
		$idLang = AdminLanguage::create($language)->id;

		if ($idLang) {
			return Redirect::action('AdminIntroduceController@index');
		}
		dd(123);
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
		$introduce = AdminLanguage::where('model_id', $id)->where('model_name', 'Introduce')->first();
		if ($introduce) {
			return View::make('admin.introduce.edit')->with(compact('introduce'));
		}
		return Redirect::action('AdminIntroduceController@index');
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

		$viInput['title'] = $input['title'];
		$viInput['description'] = $input['description'];
		$viInput['css'] = $input['css'];
		$viInput['position'] = $input['position'];
		CommonNormal::update($id, $viInput);

		$enInput['title'] = $input['en_title'];
		$enInput['description'] = $input['en_description'];
		$enInput['css'] = $input['css'];
		$enInput['position'] = $input['position'];
		$en = AdminLanguage::where('model_name', 'Introduce')
			->where('model_id', $id)
			->first();
		if ($en) {
			$idEn = $en->relate_id;
			CommonNormal::update($idEn, $enInput);
		}
		return Redirect::action('AdminIntroduceController@index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Common::deleteLanguage($id, 'Introduce');
		return Redirect::action('AdminIntroduceController@index');
	}


}
