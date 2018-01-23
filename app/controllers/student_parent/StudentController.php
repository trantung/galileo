<?php
class StudentController extends BaseController {
    // public function __construct() {
    //     $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
    // }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Student::all();
        return View::make('student.index')->with(compact('data'));
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
       $center = Center::lists('name', 'id');
        return View::make('student.create')->with(compact('class', 'subject', 'level', 'center'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::except('_token');
        // dd($input);
        $input['password'] = Hash::make($input['password']);

        $student = Student::create($input);
        if( !empty($student->id) ){
            if( count($input['level_old_id']) ){
                $student->levels()->attach(
                    $input['level_old_id'], 
                    [
                        'status' => 0,
                        'class_id' => $input['class_old_id'],
                        'subject_id' => $input['subject_old_id']
                    ]
                );
            }
            if( !empty($input['level_id']) ){
                $student->levels()->attach(
                    $input['level_id'],
                    [
                        'status' => 1,
                        'class_id' => $input['class_id'],
                        'subject_id' => $input['subject_id']
                    ]
                );
            }
            $family = Family::create(['fullname_dad' => $input['dad_fullname']]);
        }
        return Redirect::action('StudentController@index')->withMessage('<i class="fa fa-check-square-o fa-lg"></i> 
            Người dùng đã được tạo!');
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
        $student = Student::findOrFail($id);
        return View::make('student.edit')->with(compact('student'));
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
        $input['password'] = Hash::make($input['password']);
        Student::findOrFail($id)->update($input);
        return Redirect::action('StudentController@index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return Redirect::action('StudentController@index');
    }

    public function login()
    {
        $checkLogin = Auth::admin()->check();
        if($checkLogin) {
            return Redirect::action('StudentController@index');
        } else {
            return View::make('admin.layout.login');
        }
    }
    public function doLogin()
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );
        $input = Input::except('_token');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::action('StudentController@login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $checkLogin = Auth::admin()->attempt($input, true);
            if($checkLogin) {
                return Redirect::action('StudentController@index');
            } else {
                return Redirect::action('StudentController@login');
            }
        }
    }
    public function logout()
    {
        Auth::admin()->logout();
        Session::flush();
        return Redirect::action('StudentController@login');
    }
    public function getUpload()
    {
        return View::make('test_upload');
    }
    public function postUpload()
    {
        
    }
}

