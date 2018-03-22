
<?php
class AdminController extends BaseController {
    public function __construct() {
        $this->beforeFilter('admin', array('except'=>array('login','doLogin', 'logout')));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Admin::all();
        return View::make('administrator.index')->with(compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('administrator.create');
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
        $adminId = Admin::create($input)->id;
        return Redirect::action('AdminController@index')->with('message','<i class="fa fa-check-square-o fa-lg"></i> 
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
        $admin = Admin::findOrFail($id);
        return View::make('administrator.edit')->with(compact('admin'));
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
        Admin::findOrFail($id)->update($input);
        return Redirect::action('AdminController@index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return Redirect::action('AdminController@index');
    }

    public function login()
    {
        $checkLogin = Auth::admin()->check();
        if($checkLogin) {
            return Redirect::action('DocumentController@index');
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
            return Redirect::action('AdminController@login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $checkLogin = Auth::admin()->attempt($input, true);
            if($checkLogin) {
                return Redirect::action('DocumentController@index');
            } else {
                return Redirect::action('AdminController@login');
            }
        }
        
        if ($validator->fails()) {
            return Redirect::action('UserController@login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $checkLogin = Auth::user()->attempt($input);
            if($checkLogin) {
                // dd(5555);
                return Redirect::action('UserController@index');
            } else {
                return Redirect::action('UserController@login');
            }
        }

    }
    public function logout()
    {
        Auth::admin()->logout();
        Auth::user()->logout();
        // Session::flush();
        return Redirect::action('AdminController@login');
    }
    public function getUpload()
    {
        return View::make('upload_doc');
    }
    public function postUpload()
    {
        $input = Input::except('_token');
        $destinationPath = public_path().DOCUMENT_UPLOAD_DIR;
        foreach ($input['files'] as $key => $file) {
            $filename = $file->getClientOriginalName();
            
            $classCode = $input['class'];
            $subjectCode = $input['subject'];
            $levelCode = $input['level_code'];
            $fileNameConvert = Common::getFileNameConvert($filename, $input);
            $uploadSuccess = $file->move($destinationPath.$subjectCode.'/'.$classCode.'/'.$levelCode.'/', $fileNameConvert.'.docx');
            //luu vao db
            $link = $destinationPath.$subjectCode.'/'.$classCode.'/'.$levelCode.'/';
            // $doc['file_url'] = DOCUMENT_UPLOAD_DIR.$fileNameConvert.'.docx';
            // $doc['file_url'] = DOCUMENT_UPLOAD_DIR.$fileNameConvert.'.docx';
            $files = $link.$fileNameConvert.'.docx';

            $parameters = array(
                'Secret' => KEY_API,
            );
            $result = convert_api('docx', 'pdf', $files, $parameters);
            $result = $result->Files[0]->FileData;
            $result = base64_decode($result);
            file_put_contents($link.$fileNameConvert.'.pdf', $result);
        }
        dd(555);
    }

    public function getUploadFile(){
        return View::make('upload_file');
    }

    public function postUploadFile()
    {
        $input =Input::all();
        $countDocument = count($input['document']);
        if( Input::hasFile('document') )
        {
            $files = Input::file('document');
            foreach ($files as $file) {
                $file_name = $file->getClientOriginalName();                // lấy tên file chọn 
                $nameArray = substr($file_name, 0, count($file_name)-5);    //  bỏ đuôi file
                $str = explode('_', $nameArray);                            //  tách chuối  bởi dấu _ 
                $str0 = $str[0];                                             //  lấy chuỗi đầu sau khi tách
                $title = substr($str0, 0, 1);                                // lấy ký tự đầu trong $str0  ( P-D ) 
                $subject_id = substr($str0, 1, 1);                           // lấy ký tự thứ 2 trong $str0 ( Môn )
                $str03 = substr($str0, 2, 2);                                 // lấy 2 ký tự cuối trong $str0( lớp )
                if($str03 < 10){                                              // lấy ký tự lớp mà nhỏ hơn 10  thì lấy 1 ký tự  
                    $class_id = $str03 % 10;
                }
                else{
                    $class_id = $str03;                    // nêu lớn hơn thì lấy 2 ký tự
                }
                $levelCode = $str[1];
                $lessonCode = $str[2];
                $version = $str[3];
                $typeCode = ($title == 'P') ? P : D;
                $classCode = ClassModel::where('code', $class_id)->first();
                $subjectCode = Subject::where('code', $subject_id)->first();
                $levelCode = Level::where('code', $levelCode)
                        ->where('class_id', $classCode->id)
                        ->where('subject_id', $subjectCode->id)
                        ->first();
                $check = Document::where('code', $nameArray)->first();
                $documentEmpty = count($check);
                if($documentEmpty > 0){
                    dd('chua hieu update nhu the nao');
                }
                else{
                    $link = $class_id.'/'.$subject_id.'/'.$levelCode.'/'.$lessonCode.'/';
                    $linkDefault = DOCUMENT_UPLOAD_DIR.'/'.$link.'/';
                    $filee = public_path().'/'.$linkDefault;
                    $uploadSuccess = $file->move($filee, $file_name);
                    $field = [
                    'file_url' => $linkDefault.$file_name,
                    'type_id'  => $typeCode,
                    'code'     => $nameArray,
                    'class_id' => $classCode->id,
                    'subject_id' => $subjectCode->id,
                    'level_id' => $levelCode->id,
                    'lesson_id' => $lessonCode,
                    'status'   =>1
                    ];
                    if( $uploadSuccess ){                   // Neu upload thanh cong thi luu url vao database
                        $documentId = Document::create($field)->id;
                        Document::find($documentId)->update(['parent_id' => $documentId]);
                    }
                }
            }
        }
       return  Redirect::back()->withMessage('Bạn đã upload thành công ! '.$countDocument.' file');
    }







    public function getResetPass($id)
    {
        return View::make('administrator.reset')->with(compact('id'));
    }
    public function postResetPass($id)
    {
        $input = Input::all();
        $admin = Admin::find($id);
        $password = Hash::make($input['password']);
        $admin->update(['password' => $password]);
        return Redirect::action('AdminController@index');

    }
}

