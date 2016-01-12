<?php

class NewsController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$inputNew = AdminNew::orderBy('id', 'desc')->paginate(PAGINATE);

		return View::make('admin.news.index')->with(compact('inputNew'));
	}
	public function search()
	{
		$input = Input::all();
		$inputNew = NewsManager::searchNews($input);

		return View::make('admin.news.index')->with(compact('inputNew'));
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
			'name'   => 'required'

		);
		$input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('NewsController@create')
	            ->withErrors($validator)
	            ->withInput(Input::except('name'));
        } else {
        	//create news
        	$inputNews = Input::only('type_new_id', 'name', 'description','start_date');
        	if($inputNews['start_date'] == '') {
        		$inputNews['start_date'] = Carbon\Carbon::now();
        	}
			$id = CommonNormal::create($inputNews);

			//upload image new
			$input['image_url'] = CommonSeo::uploadImage($id, UPLOADIMG, 'image_url',UPLOAD_NEWS);
			CommonNormal::update($id, ['image_url' => $input['image_url']] );

			// insert ceo
			CommonSeo::createSeo('AdminNew', $id, FOLDER_SEO_NEWS);

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
		$inputNew = AdminNew::find($id);
		$inputSeo = AdminSeo::where('model_id', $id)->where('model_name', 'AdminNew')->first();
		return View::make('admin.news.edit')->with(compact('inputNew','inputSeo'));
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
				'name'   => 'required'
			);
			$input = Input::except('_token');
			$validator = Validator::make($input,$rules);
			if($validator->fails()) {
				return Redirect::action('NewsController@edit',$id)
		            ->withErrors($validator)
		            ->withInput(Input::except('name'));
	        } else {
	        	//update News
	        	$inputNews = Input::only('type_new_id', 'name', 'description','start_date');
	        	if($inputNews['start_date'] == '') {
	        		$inputNews['start_date'] = Carbon\Carbon::now();
	        	}
				CommonNormal::update($id, $inputNews);

				//update upload image
				$imageNews = AdminNew::find($id);
				$input['image_url'] = CommonSeo::uploadImage($id, UPLOADIMG, 'image_url',UPLOAD_NEWS,$imageNews->image_url);
				CommonNormal::update($id, ['image_url' => $input['image_url']] );
				}
        	}

			CommonSeo::updateSeo('AdminNew', $id, FOLDER_SEO_NEWS);
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
		CommonNormal::delete($id);
		return Redirect::action('NewsController@index') ;
	}

}
