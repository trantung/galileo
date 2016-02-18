<?php

class AdminContactController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->edit(1);
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
		return View::make('admin.contact.edit')->with(compact('id'));
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
            'description'   => 'required',
            // 'en_description' => 'required',
        );
        $input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('AdminContactController@edit', $id)
	            ->withErrors($validator);
        } else {
        	$inputUpdateMain = Input::only('description', 'lat', 'long');
        	$relateUpdateId = Common::getValueLanguage('Contact', $id, 'relate_id');
        	$inputUpdateRelate['description'] = $input['en_description'];
        	$inputUpdateRelate['lat'] = $input['lat'];
        	$inputUpdateRelate['long'] = $input['long'];
        	CommonNormal::update($id,$inputUpdateMain);
        	CommonNormal::update($relateUpdateId,$inputUpdateRelate);

        	$inputLanguage = Input::only('status');
        	AdminLanguage::where('model_name', 'Contact')->where('model_id', $id)->where('relate_id', $relateUpdateId)->update($inputLanguage);

			return Redirect::action('AdminContactController@edit', $id);
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
		Customer::find($id)->delete();
        return Redirect::action('AdminContactController@feedback');
	}

	public function feedback()
	{
		$data = Customer::orderBy('id', 'desc')->paginate(PAGINATE);
		return View::make('admin.contact.index')->with(compact('data'));
	}

}
