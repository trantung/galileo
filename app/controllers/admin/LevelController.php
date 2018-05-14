<?php

class LevelController extends AdminController implements AdminInterface {
	public function __construct() {
        parent::__construct();
        $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
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
		return View::make('admin.level.form_create_edit')->with(['data' => null]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::except('_token');
		// lấy subject_class_id để lưu vào bảng level
		$class = ClassModel::where('id', $data['class_id'])->first();
        $subject = Subject::where('id', $data['subject_id'])->first();
        $rules = array(
            'class_id' => 'required',
            'subject_id' => 'required',
            'code' => 'required'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::action('LevelController@create')
                ->withErrors($validator)
                ->withInput(Input::except('class_id', 'subject_id', 'code'));
        } 
        $classId = $class->id;
        $subjectId = $subject->id;
		$subjectClass = SubjectClass::where('class_id', $classId)
                ->where('subject_id', $subjectId)
                ->first();
        if (!$subjectClass) {
            dd('thieu class hoac subject');
        }
        $subjectClassId = $subjectClass->id;
        $field = [
        	'code' => $data['code'],
        	'name' => $data['name'],
        	'class_id' => $data['class_id'],
        	'subject_id' => $data['subject_id'],
        	'number_lesson' => $data['number_lesson'],
        	'subject_class_id' => $subjectClassId
        ];
		$level = Level::create($field);
        // Lấy số buổi học của trình độ
		$numberLesson = $data['number_lesson'];
            for ($i=0; $i < $numberLesson; $i++) { 
                $code = $i + 1;
                $input = [
                    'level_id' => $level->id,
                    'subject_id' => $data['subject_id'],
                    'class_id' => $data['class_id'],
                    'name' => 'Buổi '. $code,
                    'code' => $code,
                    'status' => 1,
                ];
                Lesson::create($input);
            }
		return Redirect::action('LevelController@index');
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
		$data = Level::findOrFail($id);
		return View::make('admin.level.form_create_edit')->with(compact('data'));
	}
	


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Level::findOrFail($id);
		$input = Input::only(['name', 'number_lesson']);
		$numberData = $data->number_lesson;
		if($input['number_lesson'] <= $numberData)
		{
			return Redirect::back()->withInput($input)->withMessage('Số buổi học chỉ được phép tăng. Số buổi phải lớn hơn số hiện tại!');
		}

		$level = CommonNormal::update($id, $input, 'Level');

		$numberInput = $input['number_lesson'];
		for ( $i = $numberData + 1 ; $i <= $numberInput ; $i++) { 
            $field = [
                'level_id' => $id,
                'subject_id' => $data['subject_id'],
                'class_id' => $data['class_id'],
                'name' => 'Buổi '. $i,
                'code' => $i,
                'status' => 1,
            ];
            Lesson::create($field);
        }
		return Redirect::action('LevelController@index')->withMessage('Cập nhật thành công!');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Level::find($id)->delete();
		return Redirect::action('LevelController@index');	
	}


}
