<?php

class AdminAboutUsController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = AdminLanguage::where('model_name', 'AboutUs')->orderBy('id', 'desc')->paginate(PAGINATE);
		return View::make('admin.about.index')->with(compact('data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.about.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'title'   => 'required',
			// 'en_title'   => 'required',
			'type_id' => 'required',
			'position' => 'integer|min:1',
			'weight' => 'integer|min:1'
		);
		$input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('AdminAboutUsController@create')
	            ->withErrors($validator)
	            ->withInput(Input::except('title'));
        } else {

        	$viInputAboutUs = Input::only('type_id', 'title', 'description', 'weight');
			$viId = CommonNormal::create($viInputAboutUs);

			$enInput['title'] = Input::get('en_title');
			$enInput['description'] = Input::get('en_description');
			$typeNewIdRelate = Common::getValueLanguage('TypeAboutUs', Input::get('type_id'), 'relate_id');
			$enInput['type_id'] = $typeNewIdRelate;
			$enId = CommonNormal::create($enInput);

			//upload image new
			$inputImg['image_url'] = CommonUpload::uploadImage($viId, UPLOADIMG, 'image_url',UPLOAD_ABOUT);
			CommonNormal::update($viId, ['image_url' => $inputImg['image_url']] );
			CommonNormal::update($enId, ['image_url' => $inputImg['image_url']] );

			$language['model_name'] = 'AboutUs';
			$language['relate_name'] = 'AboutUs';
			$language['model_id'] = $viId;
			$language['relate_id'] = $enId;
			// $language['status'] = Input::get('status');
			// if(!empty(Input::get('position'))) {
			// 	$language['position'] = Input::get('position');
			// } else {
			// 	$language['position'] = 1;
			// }
			AdminLanguage::create($language);

			// insert ceo
			// CommonUpload::createSeo('AboutUs', $id, FOLDER_SEO_NEWS);

			return Redirect::action('AdminAboutUsController@index');
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
		return View::make('admin.about.edit')->with(compact('id'));
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
			'title'   => 'required',
			// 'en_title'   => 'required',
			'type_id' => 'required',
			'position' => 'integer|min:1',
			'weight' => 'integer|min:1'
		);
		$input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('AdminAboutUsController@edit',$id)
	            ->withErrors($validator)
	            ->withInput(Input::except('title'));
        } else {
        	$inputNews = Input::only('type_id', 'title', 'description', 'weight');
        	$relateUpdateId = Common::getValueLanguage('AboutUs', $id, 'relate_id');
        	$inputUpdateRelate['title'] = $input['en_title'];
        	$inputUpdateRelate['description'] = $input['en_description'];
        	$inputUpdateRelate['type_id'] = Common::getValueLanguage('TypeAboutUs', Input::get('type_id'), 'relate_id');
        	CommonNormal::update($id,$inputNews);
        	CommonNormal::update($relateUpdateId,$inputUpdateRelate);

        	// $inputLanguage = Input::only('position');
        	//AdminLanguage::where('model_name', 'AboutUs')->where('model_id', $id)->where('relate_id', $relateUpdateId)->update($inputLanguage);

			//update upload image
			$imageAbout = AboutUs::find($id);
			$input['image_url'] = CommonUpload::uploadImage($id, UPLOADIMG, 'image_url',UPLOAD_ABOUT,$imageAbout->image_url);
			CommonNormal::update($id, ['image_url' => $input['image_url']] );
			CommonNormal::update($relateUpdateId, ['image_url' => $input['image_url']] );
		}
		return Redirect::action('AdminAboutUsController@index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Common::deleteLanguage($id, 'AboutUs');
		return Redirect::action('AdminAboutUsController@index') ;
	}


}
