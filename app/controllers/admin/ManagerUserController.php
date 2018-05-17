<?php
class ManagerUserController extends AdminController implements AdminInterface{

    public function __construct() {
        // parent::__construct();
        // $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
        
        //---ĐÃ ĐÓNG 2 DÒNG TRÊN LẠI ĐỂ VÀO ACCOUNT_USER--//
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
        //  //
        // }
        $input = Input::all();
        $users = User::orderBy('created_at', 'DESC');
        if( !empty($input['key']) ){
            $users->where('username', 'like', $input['key'])
                ->orWhere('email', 'like', $input['key'])
                ->orWhere('full_name', 'like', $input['key']);
        }
        if( !empty($input['role_id']) ){
            $users->where('role_id', $input['role_id']);
        }
        if( !empty($input['center_id']) ){
            $users->whereHas('centers', function($q)
            {
                $q->where('center_id', Input::get('center_id'));
            });
        }

        $users = $users->paginate(PAGINATE);
        return View::make('admin.user.index')->with(compact('users'));
    }

    public function getSetTime($id)
    {
        $data = Common::getFreeTimeOfUser($id);
        return View::make('admin.user.set-time')->with(compact('id', 'data'));
    }

    public function postSetTime($id)

    {
       $input =Input::all();
       FreeTimeUser::where('user_id',$id)->delete();
        foreach($input['start_time'] as $key => $value) {
            foreach ($value as $k => $time) {
                if(!empty($input['start_time'][$key][$k]) && !empty($input['end_time'][$key][$k]) && strtotime($input['end_time'][$key][$k]) > strtotime($input['start_time'][$key][$k])){
                    $field = [
                        'user_id'=>$id,
                        'time_id'=> $key,
                        'start_time' => $input['start_time'][$key][$k],
                        'end_time' => $input['end_time'][$key][$k]
                    ];
                    CommonNormal::create($field, 'FreeTimeUser');
                }

            }
        }
        return Redirect::action('ManagerUserController@getSetTime', $id);
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
        $input = Input::except('center_id');
        $check = Common::checkExist('User', $input['username'], 'username');
        if ($check) {
            $message = 'Username đã tồn tại';
            return Redirect::back()->with(compact('message'));
        }
        //tao moi
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        
        $centerId = !empty(Input::get('center_id')) ? Input::get('center_id') : [];
        $levelId = !empty(Input::get('level')) ? Input::get('level') : [];
        $user->centers()->sync( array_values($centerId) );
        $user->levels()->sync( array_values($levelId) );
        // foreach ($listLevelId as $key => $value) {
        //     foreach ($value as $k => $levelId) {
        //         $userCenterLevel = CenterLevel::where('level_id', $levelId)
        //             ->where('center_id', $key)
        //             ->first();
        //         if (!$userCenterLevel) {
        //             // dd('sai config');
        //         }
        //         $userCenterLevelId = $userCenterLevel->id;
        //         UserCenterLevel::create([
        //             'user_id' => $userId,
        //             'center_id' => $key,
        //             'center_level_id' => $userCenterLevelId,
        //             'level_id' => $levelId
        //         ]);
        //     }
            
        // }
        return Redirect::action('ManagerUserController@index')->withMessage('Lưu thông tin thành viên thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function account_user($id)
    {
        $data = User::findOrFail($id);
        return View::make('admin.user.account_user')->with(compact('data'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        $centerData = $data->centers()->lists('center_id');
        $levelData = $data->levels()->lists('level_id');
        // dd($levelData);

        return View::make('admin.user.edit')->with( compact('data', 'levelData', 'centerData') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::findOrFail($id);
        $input = Input::except(['center_id', 'level', 'password', 'username', 'email']);
        if( !empty(Input::get('password')) ){
            $input['password'] = Hash::make(Input::get('password'));
        }
        CommonNormal::update($id, $input);

        $centerId = !empty(Input::get('center_id')) ? Input::get('center_id') : [];
        $levelId = !empty(Input::get('level')) ? Input::get('level') : [];
        $user->centers()->sync( array_values($centerId) );
        $user->levels()->sync( array_values($levelId) );

        // if( !empty($input['level']) ){
        //     // Neu co nhap trinh do cua cac mon hoc
        //     $levelIds = $input['level'];
        //     $levelOlds = Common::getLevelOfUser($id);
        //     $levelAdds = array_diff($levelIds, $levelOlds); // Lay cac Id moi de them vao
        //     $levelDels = array_diff($levelOlds, $levelIds); // Lay cac Id se xoa
        //     foreach ($levelDels as $key => $levelId) {
        //         UserCenterLevel::where('user_id', $id)->where('level_id', $levelId)->delete();
        //     }
        //     foreach ($levelAdds as $key => $levelId) {
        //         // Them moi level
        //         $userCenterLevel = CenterLevel::where('level_id', $levelId)
        //             ->where('center_id', $input['center_id'])
        //             ->first();
        //         if ($userCenterLevel != null) {
        //             $userCenterLevelId = $userCenterLevel->id;
        //             UserCenterLevel::create([
        //                 'user_id' => $id,
        //                 'center_level_id' => $userCenterLevelId,
        //                 'level_id' => $levelId
        //             ]);
        //         }
        //     }

        // } else{
        //     // Neu khong nhap gi thi xoa het trong bang center_user_level
        //     $userCenterLevel = UserCenterLevel::where('user_id', $id)->delete();
        //     // if( $userCenterLevel ){
        //     //  $userCenterLevel->delete();
        //     // }
        // }
        return Redirect::back()->withMessage('Lưu thông tin thành viên thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        CommonNormal::delete($id);
        return Redirect::action('ManagerUserController@index')->withMessage('Đã xóa thành công!');
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
        $user->update(['password' => $password]);
        return Redirect::action('ManagerUserController@index');

    }
    public function getPermission($userId)
    {
        $user = User::find($userId);
        return View::make('admin.user.permission')->with(compact('userId', 'user'));
    }
    public function postPermission($userId)
    {
        $input = Input::all();
        Common::permissionDoc('User', $userId, $input);
        return Redirect::action('ManagerUserController@getPermission', $userId);
    }
    public function detroyFreeTime()
    {
        $input = Input::all();
        FreeTimeUser::where('user_id', $userId)
            ->where('time_id', $timeId)
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->delete();
        return Response::json(['đã xóa rồi nhé ']);
    }
}

