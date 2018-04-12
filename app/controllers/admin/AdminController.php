
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
    //  trùng vẫn cho up 
    // file  nào đúng vẫn cho up sai thì không cho up
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
                if( Document::where('code', $nameArray)->count() > 0 ){

                     $ob = Document::where('code', $nameArray)->first();
                     $fileUrl = $ob->file_url;
                    $re_nameArray = rename(public_path().$fileUrl, public_path().$fileUrl.'_'.$now);

                    // $error .= 'Học liệu '. $nameArray .' đã tồn tại trên hệ thống!<br>';
                    // continue;
                }


                $strArr = Common::explodeDocumentName($nameArray);
                $lessonId = Lesson::where('code', (int)$strArr['lesson_code'])->first();
                $classId = ClassModel::where('code', (int)$strArr['class_code'])->first();
                $subjectId = Subject::where('code', $strArr['subject_code'])->first();
                $levelId = Level::where('code', $strArr['level_code'])->first();
                if( empty(Common::getObject($lessonId, 'id'))
                    | empty(Common::getObject($classId, 'id'))
                    | empty(Common::getObject($subjectId, 'id'))
                    | empty(Common::getObject($levelId, 'id')) ){
                    $error .= 'Học liệu '. $nameArray .' không đúng định dạng tên!<br>';
                    continue;
                }

                $link = $strArr['subject_code'].'/'.$strArr['class_code'].'/'.$strArr['level_code'].'/'.$strArr['lesson_code'].'/';
                $linkDefault = DOCUMENT_UPLOAD_DIR.$link;
                $filee = public_path().'/'.$linkDefault;
                $uploadSuccess = $file->move($filee, $file_name);
                $field = [
                    'file_url' => $linkDefault.$file_name,
                    'type_id'  => ($strArr['type'] == 'P') ? P : D,
                    'code'     => $nameArray,
                    'class_id' => Common::getObject($classId, 'id'),
                    'subject_id' => Common::getObject($subjectId, 'id'),
                    'level_id' => Common::getObject($levelId, 'id'),
                    'lesson_id' => Common::getObject($lessonId, 'id'),
                    'status'   =>1
                ];
                if( $uploadSuccess ){      

                             // Neu upload thanh cong thi luu url vao database
                     if( Document::where('code', $nameArray)->count() == 0 ){
                        $documentId = Document::create($field)->id;
                        $ob = Document::where('lesson_id', Common::getObject($lessonId, 'id'))->first();
                            if (!$ob) {
                                dd(111);
                                $checktype = $strArr['type'];
                                dd($checktype);
                                    if($checktype == 'D'){
                                        $documentId = Document::create($field)->id;
                                    }
                                    if($checktype == 'P'){
                                        Document::find($ob)->create(['parent_id' => $ob]);

                                    }
                       } else {


                       }
                       //  //kiểm tra là xem lesson_id có bản ghi hay ko
                            //nếu không có thì kiểm tra file upload là đáp án hay phiếu
                                //nếu là đáp án thfi parent_id = null
                                //nếu là phiếu thì parent_id = documentId
                            //nếu có thì xem record là phiếu hay đáp án
                                //nếu là phiếu thì fileupload chắc chắn phải là đáp án->update parent_id của file upload là id của recored
                                // nếu là đáp án thì fileupload chắc chắn phải là phiếu->update parent_id của fileupload là id vừa tạo và update parent_id của record = id của fileupload
                        Document::find($documentId)->update(['parent_id' => $documentId]);
                    }

                }
                $countDocument++;
            }
        }
        if( !empty($error) ){
            return  Redirect::back()->withError($error);
        }
        return  Redirect::back()->withMessage('Bạn đã upload thành công ! '.$countDocument.' file');

        /** TODO **/
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

