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
        $data = Student::paginate(PAGINATE);
        return View::make('student.index')->with(compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()

    {   // create backage
        $package = Package::all();                            
        $class = ClassModel::lists('name', 'id');              
        $subject = Subject::lists('name', 'id');             
        $level = Level::lists('name', 'id');                  
        $center = Center::lists('name', 'id');
        $userActive = User::where('role_id', CVHT)->lists('username', 'id'); 
        $userNameActive = User::where('role_id', CVHT)->lists('username');
        return View::make('student.create')->with(compact('class', 'subject', 'level', 'center','package', 'userActive', 'userNameActive'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validator = Validator::make( $input,
            [
                'fullname'   => 'required',
                'password'   => 'required|min:8|confirmed',
                'code'       => 'required',
                'email'      => 'required|email|unique:student',
                'username'   => 'required|min:6|unique:student',
                'center_id'  => 'required',
                'birthday'   => 'required',
                'gender'     => 'required'
            ],
            [
                'fullname.required' => 'Bạn phải điền tên',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
                'code.required' =>'Chưa nhập mã học sinh',
                'email.required' => 'Email không hợp lệ',
                'username.required' => 'Tên đăng nhập không tồn tại',
                'center_id.required' => 'Bạn chưa chọn trung tâm',
                'birthday.required' => 'Chưa chọn ngày sinh',
                'gender.required' => 'Chưa chọn giới tính'    
            ]
        );

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }

        // create family
        $familyInput['mom_fullname'] = $input['mom_fullname'];
        $familyInput['mom_phone'] = $input['mom_phone'];
        $familyInput['dad_fullname'] = $input['dad_fullname'];
        $familyInput['dad_phone'] = $input['dad_phone'];
        // dd($input['dad_phone']);
        //get groupId
        $groupId = CommonNormal::createFamily($familyInput);
        if (!$groupId) {
            // dd('khong dc bo me');
            return Redirect::back()->withMessage('số điện thoại của bố hoặc mẹ bị trùng');
            // return Redirect::action('StudentController@index');

        }
        //create student
        $studentInput = Input::except('_token', 
            'mom_phone', 'mom_fullname',
            'dad_fullname', 'dad_phone',
            'class_id', 'subject_id',
            'level_id', 'package_id',
            'lesson_code', 'money_paid',
            'user_id', 'hours', 'manual_user'
        );
        $studentInput['family_id'] = $groupId;
        // $studentInput['class_id'] = $input['class_id'];
        //get studentId
        $studentId = Student::create($studentInput)->id;

        if (!$studentId) {
            return Redirect::back()->withErrors('Lưu không thành công!');
        }
       
        return Redirect::action('StudentController@index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        $parents = ['mom'=>null, 'dad' => null];

        foreach ($student->families as $key => $parent) {
            if( $parent->gender == 0 ){
                // Thong tin me
                $parents['mom'] = $parent;
            } else{
                // Thong tin bo
                $parents['dad'] = $parent;
            }
        }
        $center = Center::lists('name', 'id');
        return View::make('student.show')->with(compact('student', 'center', 'parents'));
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
        // $input = Input::all();
        // $input['password'] = Hash::make($input['password']);
        // Student::findOrFail($id)->update($input);
        // return Redirect::action('StudentController@index');
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

