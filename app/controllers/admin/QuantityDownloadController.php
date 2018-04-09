<?php

class QuantityDownloadController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		// dd($input);
        $data = QuantityDownload::orderBy('created_at', 'desc');
        
        if( !empty($input['class_id']) ){
            $data = $data->where('class_id', $input['class_id']);
        }
        if( !empty($input['subject_id']) ){
            $data = $data->where('subject_id', $input['subject_id']);
        }
        if( !empty($input['level_id']) ){
            $data = $data->where('level_id', $input['level_id']);
        }
        if( !empty($input['role_id']) ){
            $data = $data->where('role_id', $input['role_id']);
        }
        
		$data = $data->paginate(15);
		return View::make('admin.download.index')->with(compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$class = ClassModel::lists('name', 'id');
        $subject = Subject::lists('name', 'id');
        $level = Level::lists('name', 'id');
		return View::make('admin.download.create')->with(compact('class', 'subject', 'level'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$input['start_time'] = date('Y-m-d', strtotime(Input::get('start_time')));
		$input['end_time'] = date('Y-m-d', strtotime(Input::get('end_time')));
		$downloaId = QuantityDownload::create($input)->id;
		return Redirect::action('QuantityDownloadController@index');
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
		$quantity = QuantityDownload::findOrFail($id);
		return View::make('admin.download.edit')->with(compact('quantity'));
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
		QuantityDownload::findOrFail($id)->update($input);
		return Redirect::action('QuantityDownloadController@index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		QuantityDownload::findOrFail($id)->delete();
		return Redirect::action('QuantityDownloadController@index');
	}

	public function getChangeGV()
	{
		return View::make('admin.download.changeGV');
	}

	public function postChangeGV()
	{
		$input = Input::all();
		$field = [
			'max_account' => $input['max_account'], 
			'max_document' => $input['max_document'], 
			'start_time' => $input['start_time'], 
			'end_time' => $input['end_time'] 
		];
		$obj = QuantityDownload::where('role_id', 2)->get();
		$count = $obj->count();
		if($count > 0){
			foreach ($obj as $key => $value) {
				$value::find($value->id)->update($field);
			}
			return Redirect::action('QuantityDownloadController@index');
		}
		return Redirect::action('QuantityDownloadController@create')->withMessage('Chưa có bản ghi nào! Vui lòng tạo mới');
	}
	public function getChangePTCM()
	{
		return View::make('admin.download.changePTCM');
	}

	public function postChangePTCM()
	{
		$input = Input::all();
		$field = [
			'max_account' => $input['max_account'], 
			'max_document' => $input['max_document'], 
			'start_time' => $input['start_time'], 
			'end_time' => $input['end_time'] 
		];
		$obj = QuantityDownload::where('role_id', 3)->get();
		$count = $obj->count();
		if($count > 0){
			foreach ($obj as $key => $value) {
				$value::find($value->id)->update($field);
				return Redirect::action('QuantityDownloadController@index');
			}
		}
		return Redirect::action('QuantityDownloadController@create')->withMessage('Chưa có bản ghi nào! Vui lòng tạo mới');
	}
	public function getChangeCVHT()
	{
		return View::make('admin.download.changeCVHT');
	}

	public function postchangeCVHT()
	{
		$input = Input::all();
		$field = [
			'max_account' => $input['max_account'], 
			'max_document' => $input['max_document'], 
			'start_time' => $input['start_time'], 
			'end_time' => $input['end_time'] 
		];
		$obj = QuantityDownload::where('role_id', CVHT)->get();
		$count = $obj->count();
		if($count > 0){
			foreach ($obj as $key => $value) {
				$value::find($value->id)->update($field);
				return Redirect::action('QuantityDownloadController@index');
			}
		}
		return Redirect::action('QuantityDownloadController@create')->withMessage('Chưa có bản ghi nào! Vui lòng tạo mới');
	}

	public function getAskPermission($id)
	{
		return View::make('admin.download.askpermission')->with(compact('id'));
	}

	public function postAskPermission()
	{
		$input = Input::all();
		$admin = Auth::admin()->get();
		$document = Document::where('parent_id', $input['documnent_id'])->first();
		$field = [
			'model_id'       => $admin->id,
			'model_name'     => 'Admin',
			'document_id'    => $document->id,
			'document_code'  => $document->code,
			'status'         => 1
		];
		$askPermissionId = AskPermission::create($field)->id;
		
		return Redirect::action('DocumentController@index');
	}
}
