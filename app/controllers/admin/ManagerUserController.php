<?php
class ManagerUserController extends BaseController {
    public function __construct() {
        // $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $roleId = Auth::user()->role_id;
		// if ($roleId == 1) {
		// 	//
		// }
		$users = User::all();
		return View::make('admin.user.index')->with(compact('users'));
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
		$input = Input::all();
		// dd($input);
		$check = Common::checkExist('User', $input['username'], 'username');
		if ($check) {
			$message = 'Tồn tại username của partner';
			return View::make('admin.user.create')->with(compact('message'));
		}
		//tao moi
		$input['password'] = Hash::make($input['password']);
		$userId = User::create($input)->id;
		// dd($userId);
		$centerId = $input['center_id'];
		$listLevelId = $input['level'];
		foreach ($listLevelId as $key => $value) {
			$userCenterLevel = CenterLevel::where('level_id', $value)
				->where('center_id', $centerId)
				->first();
			if (!$userCenterLevel) {
				dd('sai config');
			}
			$userCenterLevelId = $userCenterLevel->id;
			UserCenterLevel::create([
				'user_id' => $userId,
				'center_level_id' => $userCenterLevelId,
			]);
		}
		return Redirect::action('ManagerUserController@index');
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
    	$checkLogin = Auth::admin()->check();
        if($checkLogin) {
	    	if (Auth::admin()->get()->status == ACTIVE) {
	    		return Redirect::action('ManagerController@edit', Auth::admin()->get()->id);
	    	}else{
	    		return View::make('admin.layout.login')->with(compact('message','chưa kich hoat'));
	    	}
        } else {
            return View::make('admin.layout.login');
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
            return Redirect::route('admin.login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $checkLogin = Auth::admin()->attempt($input);
            if($checkLogin) {
        		return Redirect::action('NewsController@index');
            } else {
                return Redirect::route('admin.login');
            }
        }
    }
    public function logout()
    {
        Auth::admin()->logout();
        Session::flush();
        return Redirect::route('admin.login');
    }
    public function getResetPass($id)
	{
		return View::make('admin.user.reset_password')->with(compact('id'));
	}
	public function postResetPass($id)
	{
		$input = Input::all();
		$user = User::find($id);
		$password = Hash::make($input['password']);
		$user->update(['pass' => $password]);
		return Redirect::action('ManagerUserController@index');

	}
}

