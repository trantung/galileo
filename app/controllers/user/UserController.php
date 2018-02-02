<?php
class UserController extends BaseController implements UserInterface {
    public function __construct() {
        $this->beforeFilter('user', array('except'=>array('login','doLogin', 'logout')));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('user.index');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.user.create');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

    }
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function login()
    {
    	$checkLogin = Auth::user()->check();
        if($checkLogin) {
	    	return Redirect::action('UserController@index');
        } else {
            return View::make('user.layout.login');
        }
    }
    public function doLogin()
    {
        $rules = array(
            'username'   => 'required',
            'password'   => 'required',
        );
        $input = Input::except('_token');
        $validator = Validator::make($input, $rules);
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
        Auth::user()->logout();
        Session::flush();
        return Redirect::action('UserController@login');
    }
}

