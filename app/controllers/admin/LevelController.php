<?php

class LevelController extends AdminController implements AdminInterface {
	public function __construct() {
        parent::__construct();
        // $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
        $data = Level::orderBy('created_at', 'desc');
        if( !empty($input['name']) ){
            $data = $data->where('name', 'LIKE', '%'.$input['name'].'%');
        }
        if( !empty($input['class_id']) ){
            $data = $data->where('class_id', $input['class_id']);
        }
        if( !empty($input['subject_id']) ){
            $data = $data->where('subject_id', $input['subject_id']);
        }
        if( !empty($input['level_id']) ){
            $data = $data->where('level_id', $input['level_id']);
        }
		$data = $data->paginate(30);
		return View::make('admin.level.index')->with(compact('data'));
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
		$data = Level::findOrFail($id);
		// dd($data->lessons);
		return View::make('admin.level.show')->with(compact('data'));
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
