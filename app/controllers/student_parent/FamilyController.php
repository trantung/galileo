<?php

class FamilyController extends \BaseController {

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
        $data = Admin::all();
        return View::make('student.index')->with(compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('student.create');
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
        return Redirect::action('ParentController@index')->with('message','<i class="fa fa-check-square-o fa-lg"></i> 
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
        return View::make('student.edit')->with(compact('admin'));
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
        return Redirect::action('ParentController@index');
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
        return Redirect::action('ParentController@index');
    }

    public function login()
    {
        $checkLogin = Auth::admin()->check();
        if($checkLogin) {
            return Redirect::action('ParentController@index');
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
            return Redirect::action('ParentController@login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $checkLogin = Auth::admin()->attempt($input, true);
            if($checkLogin) {
                return Redirect::action('ParentController@index');
            } else {
                return Redirect::action('ParentController@login');
            }
        }
    }
    public function logout()
    {
        Auth::admin()->logout();
        Session::flush();
        return Redirect::action('ParentController@login');
    }
    public function getUpload()
    {
        return View::make('test_upload');
    }
    public function postUpload()
    {
        
    }
}

