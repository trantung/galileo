
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
        $input = Input::all();
        $data = Admin::orderBy('created_at', 'DESC');
        if( !empty($input['key']) ){
            $data->where('username', 'like', '%'.$input['key'].'%')
                ->orWhere('email', 'like', '%'.$input['key'].'%');
                // ->orWhere('full_name', 'like', $input['key']);
        }
        if( !empty($input['role_id']) ){
            $data->where('role_id', $input['role_id']);
        }
        $data = $data->paginate(PAGINATE);

        return View::make('administrator.index')->with(compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('administrator.form');
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
        return Redirect::action('AdminController@index')->withMessage('<i class="fa fa-check-square-o fa-lg"></i> 
            Người dùng <a href="'. action('AdminController@edit', $adminId) .'">'.$input['username'].'</a> đã được tạo!');
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
        return View::make('administrator.form')->with(compact('admin'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::except('password');
        if( !empty(Input::get('password')) ){
            $input['password'] = Hash::make(Input::get('password'));
        }
        Admin::findOrFail($id)->update($input);
        return Redirect::action('AdminController@index')->withMessage('<i class="fa fa-check-square-o fa-lg"></i> 
            Người dùng <a href="'. action('AdminController@edit', $id) .'">'.$input['username'].'</a> đã được chỉnh sửa!');
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
                return Redirect::back()->withErrors('Sai tên đăng nhập hoặc mật khẩu!');
            }
        }
        
        // if ($validator->fails()) {
        //     return Redirect::back()
        //         ->withErrors($validator)
        //         ->withInput(Input::except('password'));
        // } else {
        //     $checkLogin = Auth::user()->attempt($input);
        //     if($checkLogin) {
        //         return Redirect::action('UserController@index');
        //     } else {
        //         return Redirect::action('UserController@login');
        //     }
        // }

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
             //  trùng vẫn cho up 
            // file  nào đúng vẫn cho up sai thì không cho up
    public function postUploadFile()
    {
        $input =Input::all();
        $now = time();
        $countDocument = 0;
        if( Input::hasFile('document') )
        {
            $files = Input::file('document');
            $error = '';
            foreach ($files as $key => $file) {
                if( $key > 99 ){
                    break;
                }
                
                if( $file->getClientOriginalExtension() != 'pdf' ){
                    $error .= $file->getClientOriginalName().' Sai định dạng!<br>';
                    continue;
                }
                $file_name = $file->getClientOriginalName();
                $nameArray = basename($file_name, '.pdf');   //  bỏ đuôi file

                $strArr = Common::explodeDocumentName($nameArray);
                $link = $strArr['subject_code'].'/'.$strArr['class_code'].'/'.$strArr['level_code'].'/'.$strArr['lesson_code'].'/';
                $linkDefault = DOCUMENT_UPLOAD_DIR.$link;
                $filee = public_path().$linkDefault;

                /// Lay hoc lieu theo ma phieu = ten file
                $ob = Document::where('code', $nameArray)->first();
                if( !empty($ob) ){

                    $fileUrl = $ob->file_url;
                    $file->move($filee, $file_name);

                    $error .= 'Học liệu '. $nameArray .' đã tồn tại trên hệ thống! file tài liệu sẽ được ghi đè.<br>';
                    continue;
                }
                // dd($ob);

                ///// Lay mon va lop theo ten file
                $classId = Common::getObject(ClassModel::where('code', (int)$strArr['class_code'])->first(), 'id');
                $subjectId = Common::getObject(Subject::where('code', $strArr['subject_code'])->first(), 'id');
                
                ////// Lay ID trinh do theo subject, class & ten file
                $level = Level::where('code', $strArr['level_code'])
                    ->where('class_id', $classId)
                    ->where('subject_id', $subjectId)
                    ->first();
                $levelId = Common::getObject($level, 'id');

                ////// Lay ID buoi hoc theo subject, class, level & ten file
                $lesson = Lesson::where('code', (int)$strArr['lesson_code'])
                    ->where('class_id', $classId)
                    ->where('subject_id', $subjectId)
                    ->where('level_id', $levelId)
                    ->first();
                $lessonId = Common::getObject($lesson, 'id');

                if( empty($subjectId) | empty($classId) | empty($levelId) | empty($lessonId) | !in_array($strArr['type'], ['P', 'D']) ){
                    $error .= 'Học liệu '. $nameArray .' không đúng định dạng tên!<br>';
                    continue;
                }

                $uploadSuccess = $file->move($filee, $file_name);

                if( $uploadSuccess ){
                    //Kiểm tra file upload là đáp án hay phiếu 
                    //nếu là đáp án thi parent_id = null //nếu là phiếu thì parent_id = documentId 
                    //nếu có thì xem record là phiếu hay đáp án 
                    //nếu là phiếu thì fileupload chắc chắn phải là đáp án->update parent_id của file upload là id của recored 
                    // nếu là đáp án thì fileupload chắc chắn phải là phiếu->update parent_id của fileupload là id vừa tạo và update parent_id của record = id của fileupload 

                    $field = [
                        'file_url'      => $linkDefault.$file_name,
                        'type_id'       => ($strArr['type'] == 'P') ? P : D,
                        'code'          => $nameArray,
                        'class_id'      => $classId,
                        'subject_id'    => $subjectId,
                        'level_id'      => $levelId,
                        'lesson_id'     => $lessonId,
                        'status'        => 1
                    ];
                        
                    $documentId = CommonNormal::create($field, 'Document');
                    if( $field['type_id'] == P ){
                        /* 
                         * Neu tai lieu vua upload là phieu cau hoi
                         * Thi kiem tra xem Dap an da co hay chua
                         * Lay Id cua Phieu lam parent id
                         */
                        CommonNormal::update($documentId, ['parent_id' => $documentId], 'Document');
                        Document::where( 'code', preg_replace('/P/', 'D', $nameArray, 1) )
                            ->update(['parent_id' => $documentId]);
                    } else{
                        /* 
                         * Neu tai lieu vua upload là Dap an
                         * Thi kiem tra xem Phieu cau hoi da co hay chua
                         * Lay Id cua Phieu cau hoi do lam parent id
                         */
                        $documentP = Document::where( 'code', preg_replace('/D/', 'P', $nameArray, 1) )->first();
                        if( $documentP ){
                            $documentP->update(['parent_id' => $documentP->id]);
                            CommonNormal::update($documentId, ['parent_id' => $documentP->id], 'Document');
                        }
                    }
                }
                $countDocument++;
            }
        }
        if( !empty($error) ){
            return  Redirect::back()->withError($error);
        }
        return  Redirect::back()->withMessage('Bạn đã upload thành công ! '.$countDocument.' file');

        /* TODO */
        // Chua check parent_ID
        // Chua gioi han so luong upload
        // Chua check phien ban Document
        // 
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

