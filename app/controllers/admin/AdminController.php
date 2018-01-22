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
    }
    public function logout()
    {
        Auth::admin()->logout();
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
            $uploadSuccess = $file->move($destinationPath.$classCode.'/'.$subjectCode.'/'.$levelCode.'/', $fileNameConvert.'.docx');
            //luu vao db
            $link = $destinationPath.$classCode.'/'.$subjectCode.'/'.$levelCode.'/';
            // $doc['file_url'] = DOCUMENT_UPLOAD_DIR.$fileNameConvert.'.docx';
            // $doc['file_url'] = DOCUMENT_UPLOAD_DIR.$fileNameConvert.'.docx';
            $files = $link.$fileNameConvert.'.docx';

            $parameters = array(
                'Secret' => KEY_API,
            );
            $result = convert_api('docx', 'pdf', $files, $parameters);
            $result = $result->Files[0]->FileData;
            $result = base64_decode($result);
            file_put_contents($destinationPath.$fileNameConvert.'.pdf', $result);
        }
        dd(555);
    }
}

