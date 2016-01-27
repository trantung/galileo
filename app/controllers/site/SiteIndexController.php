<?php

class SiteIndexController extends SiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$viDes = DesContent::find(1);
		$enDes = DesContent::find(2);
		$introduces = AdminLanguage::where('model_name', 'Introduce')->orderBy('position', 'asc')->get();
		// dd(LaravelLocalization::setLocale());
		return View::make('site.index')->with(compact('viDes', 'enDes', 'introduces'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

	public function slug($slug)
	{
		//from $slug to get model_name and model_id in the menus table
		$menu = Menu::findBySlug($slug);
		if (empty($menu)) {
			return Redirect::action('SiteIndexController@404');
		}
		if ($menu->model_name == 'AboutUs') {
			return Redirect::action('SiteIndexController@aboutUs');
		}
		if ($menu->model_name == 'Contact') {
			return Redirect::action('SiteIndexController@contact');
		}
		return Redirect::action('SiteIndexController@typeNew');
	}

	public function sendLang()
	{
		$input = Input::all();
		if ($input['lang'] == $input['lang_current']) {
			return $input['url'];
		}
		else{
			if($input['lang_current'] == 'vi') {
				if($input['link_url'] == 'gioi-thieu') {
					return url('/en/about');
				}
				if($input['link_url'] == 'lien-he') {
					return url('/en/contact');
				}
				if(!empty($input['link_url'])) {
					$type = TypeNew::findBySlug($input['link_url']);
					if(!empty($type)) {
						$obj = Common::objectLanguage2('TypeNew', $type->id, LANG_VI);
						$slug = $obj->slug;
					}
				} else {
					$slug = '';
				}
				if(!empty($input['link_url2'])){
					$news = AdminNew::findBySlug($input['link_url2']);
					if(!empty($news)) {
						$obj = Common::objectLanguage2('AdminNew', $news->id, LANG_VI);
						$slugChild = $obj->slug;
					}
				} else {
					$slugChild = '';
				}
				return url('/en/'.$slug.'/'.$slugChild);
			}
			if($input['lang_current'] == 'en') {
				if($input['link_url'] == 'about') {
					return url('/vi/gioi-thieu');
				}
				if($input['link_url'] == 'contact') {
					return url('/vi/lien-he');
				}
				if(!empty($input['link_url'])) {
					$type = TypeNew::findBySlug($input['link_url']);
					if(!empty($type)) {
						$obj = Common::objectLanguage2('TypeNew', $type->id, LANG_EN);
						$slug = $obj->slug;
					}
				} else {
					$slug = '';
				}
				if(!empty($input['link_url2'])){
					$news = AdminNew::findBySlug($input['link_url2']);
					if(!empty($news)) {
						$obj = Common::objectLanguage2('AdminNew', $news->id, LANG_EN);
						$slugChild = $obj->slug;
					}
				} else {
					$slugChild = '';
				}
				return url('/vi/'.$slug.'/'.$slugChild);
			}
		}
	}
}
