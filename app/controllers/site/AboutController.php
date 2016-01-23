
<?php

class AboutController extends SiteController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$viId = AdminLanguage::where('model_name', 'TypeAboutUs')->lists('model_id');
		$enId = AdminLanguage::where('model_name', 'TypeAboutUs')->lists('relate_id');
		$viData = TypeAboutUs::whereIn('id', $viId)->orderBy('position')->get();
		$enData = TypeAboutUs::whereIn('id', $enId)->orderBy('position')->get();

		// $viData = DB::table('type_about_us')
		// 				->join('languages', 'languages.model_id', '=', 'type_about_us.id')
		// 				->select('type_about_us.id', 'type_about_us.name', 'type_about_us.name_shadow', 'languages.position', 'languages.status')
		// 				->whereNull('type_about_us.deleted_at')
		// 				->distinct()
		// 				->orderBy('languages.position', 'asc')
		// 				->get();
		// $enData = DB::table('type_about_us')
		// 				->join('languages', 'languages.model_id', '=', 'type_about_us.id')
		// 				->select('type_about_us.id', 'type_about_us.name', 'type_about_us.name_shadow', 'languages.position', 'languages.status')
		// 				->whereNull('type_about_us.deleted_at')
		// 				->distinct()
		// 				->orderBy('languages.position', 'asc')
		// 				->get();

		return View::make('site.about.showAbout')->with(compact('viData', 'enData'));

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
	public function show($slug)
	{
		
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


}
