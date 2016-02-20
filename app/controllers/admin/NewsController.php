<?php

class NewsController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$inputNew = AdminLanguage::where('model_name', 'AdminNew')->orderBy('id', 'desc')->paginate(PAGINATE);
		return View::make('admin.news.index')->with(compact('inputNew'));
	}

	public function search()
	{
		$input = Input::all();
		// dd($input);
		$inputNew = NewsManager::searchNews($input);
		return View::make('admin.news.index')->with(compact('inputNew', 'input'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.news.create');
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
			'position' => 'integer|min:1'
		);
		$input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('NewsController@create')
	            ->withErrors($validator)
	            ->withInput(Input::except('name'));
        } else {

        	$viInputNews = Input::only('type_new_id', 'name', 'description');
			$viId = CommonNormal::create($viInputNews);

			$enInput['name'] = Input::get('en_name');
			$enInput['description'] = Input::get('en_description');
			$typeNewIdRelate = Common::getValueLanguage('TypeNew', Input::get('type_new_id'), 'relate_id');
			$enInput['type_new_id'] = $typeNewIdRelate;
			$enId = CommonNormal::create($enInput);

			//upload image new
			$inputImg['image_url'] = CommonUpload::uploadImage($viId, UPLOADIMG, 'image_url',UPLOAD_NEWS);
			CommonNormal::update($viId, ['image_url' => $inputImg['image_url']] );
			CommonNormal::update($enId, ['image_url' => $inputImg['image_url']] );

			$language['model_name'] = 'AdminNew';
			$language['relate_name'] = 'AdminNew';
			$language['model_id'] = $viId;
			$language['relate_id'] = $enId;
			$language['status'] = Input::get('status');
			if(!empty(Input::get('position'))) {
				$language['position'] = Input::get('position');
			} else {
				$language['position'] = 1;
			}
			AdminLanguage::create($language);

			// insert ceo
			// CommonUpload::createSeo('AdminNew', $id, FOLDER_SEO_NEWS);

			return Redirect::action('NewsController@index');
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
		return View::make('admin.news.edit')->with(compact('id'));
		// $inputNew = AdminNew::find($id);
		// $inputSeo = AdminSeo::where('model_id', $id)->where('model_name', 'AdminNew')->first();
		// return View::make('admin.news.edit')->with(compact('inputNew','inputSeo'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!Admin::isSeo()){
			$rules = array(
				'name'   => 'required',
				// 'en_name' => 'required'
			);
			$input = Input::except('_token');
			$validator = Validator::make($input,$rules);
			if($validator->fails()) {
				return Redirect::action('NewsController@edit',$id)
		            ->withErrors($validator)
		            ->withInput(Input::except('name'));
	        } else {

		        	$inputNews = Input::only('type_new_id', 'name', 'description');
		        	$relateUpdateId = Common::getValueLanguage('AdminNew', $id, 'relate_id');
		        	$inputUpdateRelate['name'] = $input['en_name'];
		        	$inputUpdateRelate['description'] = $input['en_description'];
		        	$inputUpdateRelate['type_new_id'] = Common::getValueLanguage('TypeNew', Input::get('type_new_id'), 'relate_id');
		        	CommonNormal::update($id,$inputNews);
		        	CommonNormal::update($relateUpdateId,$inputUpdateRelate);
		        	$inputLanguage = Input::only('position', 'status');
		        	AdminLanguage::where('model_name', 'AdminNew')->where('model_id', $id)->where('relate_id', $relateUpdateId)->update($inputLanguage);

					//update upload image
					$imageNews = AdminNew::find($id);
					$input['image_url'] = CommonUpload::uploadImage($id, UPLOADIMG, 'image_url',UPLOAD_NEWS,$imageNews->image_url);
					CommonNormal::update($id, ['image_url' => $input['image_url']] );
					CommonNormal::update($relateUpdateId, ['image_url' => $input['image_url']] );
				}
        	}

			return Redirect::action('NewsController@index') ;

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Common::deleteLanguage($id, 'AdminNew');
		return Redirect::action('NewsController@index') ;
	}

}
