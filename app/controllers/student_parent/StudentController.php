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
        $input['password'] = Hash::make($input['password']);
        $studentId = Student::create($input);
        if($studentId){
            foreach($input['subject_id'] as $value){
                $studentlevel = StudentLevel::create(['student_id' => $studentId->id, 'level_id' => $input['program_learned'], 'class_id' => $input['class_id'], 'subject_id' => $value]);
            }
        }
        return Redirect::action('StudentController@index')->with('message','<i class="fa fa-check-square-o fa-lg"></i> 
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

