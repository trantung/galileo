<?php

class BottomTextController extends AdminController {

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
		return View::make('admin.bottomtext.edit')->with(compact('id'));
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
            // 'en_title' => 'required',
        );
        $input = Input::except('_token');
		$validator = Validator::make($input,$rules);
		if($validator->fails()) {
			return Redirect::action('BottomTextController@edit', $id)
	            ->withErrors($validator);
        } else {
        	$inputUpdateMain = Input::only('title', 'description', 'link');
        	$relateUpdateId = Common::getValueLanguage('BottomText', $id, 'relate_id');
        	$inputUpdateRelate['title'] = $input['en_title'];
        	$inputUpdateRelate['description'] = $input['en_description'];
        	$inputUpdateRelate['link'] = $input['link'];
        	CommonNormal::update($id,$inputUpdateMain);
        	CommonNormal::update($relateUpdateId,$inputUpdateRelate);

        	$inputLanguage = Input::only('status');
        	AdminLanguage::where('model_name', 'BottomText')->where('model_id', $id)->where('relate_id', $relateUpdateId)->update($inputLanguage);

			return Redirect::action('BottomTextController@edit', $id);
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
		//
	}


}
