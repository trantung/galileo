<?php

/*
    Hệ thống
    1. Quản lý partner
    2. Quản lý trung tâm
    3. Quản lý lớp học
    4. Quản lý môn học
    5. Quản lý gói bán 
    6. Quản lý khuyến mãi
    7. Quản lý học liệu 
*/
// Route::get('/test', function(){
//     return View::make('test_upload');
// });
Route::get('/', 'LandingPageController@index');
Route::post('/', 'LandingPageController@store');
Route::get('/thong-ke-landing', 'LandingPageController@admin');
// Route::resource('/dang-ky-thi', 'LandingPageController');
Route::get('/update_check_doc_per', function(){
    $permissionId = Permission::create([
        'controller' => 'DocumentController',
        'action' => 'getCheckDoc',
        'model' => 'Document',
    ])->id;
    $group = Group::where('code', 'KDHL')->first();
    if ($group) {
        RelationPerGroup::create([
            'group_id' => $group->id,
            'permission_id' => $permissionId
        ]);
        dd('success');
    }
    dd($group);
});
Route::get('/update_center_level_id_cvht', function(){
    $centerId = 2;
    $listLevelId = [$centerId => Level::lists('id')];
    foreach ($listLevelId as $key => $value) {
        foreach ($value as $k => $levelId) {
            $userCenterLevel = CenterLevel::where('level_id', $levelId)
                ->where('center_id', $key)
                ->first();
            if (!$userCenterLevel) {
                dd('sai config');
            }
            $userCenterLevelId = $userCenterLevel->id;
            foreach (User::lists('id') as $userId) {
                UserCenterLevel::create([
                    'user_id' => $userId,
                    'center_id' => $key,
                    'center_level_id' => $userCenterLevelId,
                    'level_id' => $levelId
                ]);
            }
        }
    }
    dd(1111);
});

Route::get('/update_permission_user_depend_subject', function(){
    $listUser = User::all();
    $group = PermissionGroup::where('code', 'VHL')->first();
    if (!$group) {
        dd(1);
    }
    $groupId = $group->id;
    foreach ($listUser as $key => $user) {
        $userCenterLevel = UserCenterLevel::where('user_id', $user->id)
            ->first();
        $level = Level::find($userCenterLevel->level_id);
        $subjectId = $level->subject_id;
        $input['group_id'] = $groupId;
        $input['subject_id'] = $subjectId;
        $input['model_name'] = 'User';
        $input['model_id'] = $user->id;
        AccessPermisison::create($input);
    }
    dd(4444);
});
Route::get('/per-update', function(){
    $array = getMethodDefault('DocumentController');
    foreach ($array as $key => $value) {
        Permission::create([
            'controller' => $value,
            'action' => $key,
            'model' => 'Document',
        ]);
    }
    $array1 = ['index', 'show'];

    foreach ($array1 as $k => $v) {
        Permission::create([
            'controller' => 'LevelController',
            'action' => $v,
        ]);
    }
});
Route::get('/calendar_test', 'TestController@calendar');

Route::get('/update_password_user', function(){
    User::orderBy('id','asc')->update(['password' => Hash::make('123456')]);
    dd(111);
});
Route::get('/update_username_user', function(){
    $list = User::all();
    foreach ($list as $key => $value) {
        $email = $value->email;
        $str = explode('@', $email);
        $value->update(['username' => $str[0]]);
    }
    dd(111);
});
Route::get('/test/insertdb/T', 'TestController@insert');
Route::get('/test/insertdb/V', 'TestController@insertVan');
Route::get('/test/updatedb', 'TestController@updatedb');
Route::get('/test/updatedb/T', 'TestController@updatedbT');
Route::get('/test/import', 'TestController@import');
Route::controller('/test', 'TestController');


// Route::resource('/', 'AdminController');
    
Route::get('/parent/update', function(){
    $docs = Document::groupBy('lesson_id')->get();
    foreach ($docs as $key => $doc) {
        $docP = Document::where('lesson_id', $doc->lesson_id)
            ->where('type_id', P)
            ->first();
        if ($docP) {
            $docD = Document::where('lesson_id', $doc->lesson_id)
                ->where('type_id', D)
                ->first();
            if ($docD) {
                $docD->update(['parent_id' => $docP->id]);
            }
        }
    }
    dd(123);
});
Route::get('/test/upload', 'AdminController@getUpload');
Route::post('/test/upload', 'AdminController@postUpload');

Route::get('/uploadfile', 'AdminController@getUploadFile');
Route::post('/uploadfile', 'AdminController@postUploadFile');

// Route::get('/', 'AdminController@index');
Route::group(['prefix' => 'admin'], function () {

	// Route::resource('/administrator', 'AdminController');
    Route::get('/login', array('uses' => 'AdminController@login', 'as' => 'admin.login'));
    Route::post('/login', array('uses' => 'AdminController@doLogin'));
    Route::get('/logout', 'AdminController@logout');
    
    Route::get('administrator/{id}/reset', 'AdminController@getResetPass');
    Route::post('/administrator/{id}/reset', 'AdminController@postResetPass');
    //Quản lý phân quyền
    Route::resource('/permission/group', 'PermissionGroupController');
    Route::resource('/permission', 'PermissionController');

    //
    Route::resource('administrator', 'AdminController');
    Route::post('/schedule/additional/update/{id}/{student_id}', 'ScheduleController@postUpdateAdditional');
    Route::post('/schedule/additional/{id}/{student_id}', 'ScheduleController@postAdditional');
    
    Route::resource('student', 'StudentController');
    Route::resource('schedule', 'ScheduleController');
    Route::get('student_package', 'ScheduleController@course');
    Route::put('student_package/{id}', 'ScheduleController@courseEdit');
    Route::get('document_link/{id}/{student_id}', 'ScheduleController@documentLink');
    // Route quantity download

    Route::get('download/GV', 'QuantityDownloadController@getChangeGV');
    Route::get('download/PTCM', 'QuantityDownloadController@getChangePTCM');
    Route::get('download/CVHT', 'QuantityDownloadController@getChangeCVHT');

    Route::post('download/GV', 'QuantityDownloadController@postChangeGV');
    Route::post('download/PTCM', 'QuantityDownloadController@postChangePTCM');
    Route::post('download/CVHT', 'QuantityDownloadController@postChangeCVHT');

    Route::post('download/ask_permission/{documentId}', 'QuantityDownloadController@postAskPermission');
    Route::post('download/ask_permission', 'QuantityDownloadController@postAskPermission');

    Route::resource('ask_permission', 'AskPermissionController');

    Route::resource('download', 'QuantityDownloadController');
    
    
    
       /* Quản lý partner: CRUD đối tác: tên, email, username, password, sđt
        1. Controller: ManagerPartnerController 
        2. table: partners
        3. view: admin.partner
    */
    Route::get('/partner/{id}/reset-password', 'ManagerPartnerController@getResetPass');
    Route::post('/partner/{id}/reset-password', 'ManagerPartnerController@postResetPass');
    Route::resource('/partner', 'ManagerPartnerController');

    Route::resource('/class', 'ClassController');
	Route::resource('/subject', 'SubjectController');

    /*
        Quản lý trung tâm: CRUD trung tâm: tên, địa chỉ
        1. Controller: ManagerCenterController 
        2. table: center
        3. view: admin.center
    */
    Route::resource('/center', 'ManagerCenterController');

    /*
        Quản lý thành viên trung tâm: CRUD thành viên: tên, địa chỉ
        1. Controller: user/UserController 
        2. table: users
        3. view: admin.user
    */
    Route::get('/user/{id}/reset-password', 'ManagerUserController@getResetPass');
    Route::post('/user/{id}/reset-password', 'ManagerUserController@postResetPass');

    Route::get('/user/{id}/set-time', 'ManagerUserController@getSetTime');
    Route::post('/user/{id}/set-time', 'ManagerUserController@postSetTime');
    Route::post('/user/{userId}/{timeId}/{startTime}/{endTime}/set-time', 'ManagerUserController@detroyFreeTime');
    Route::get('/user/account_user/{id}', 'ManagerUserController@account_user');
    Route::get('logout_user', 'ManagerUserController@logout');

    Route::resource('/user', 'ManagerUserController');
    Route::controller('/user', 'ManagerUserController');
    // Route::resource('/', 'AdminController');

    /*
        Quản lý Level: CRUD level: tên, số buổi học
        1. Controller: admin/LevelController 
        2. table: levels
        3. view: admin.level
    */
    Route::resource('/level', 'LevelController');

    /*
        Quản lý học liệu: CRUD học liệu
        1. Controller: admin/DocumentController 
        2. table: documents
        3. view: admin.level.show
    */
    Route::resource('/doc', 'DocumentController');
    Route::controller('/doc', 'DocumentController');

    /*
        Quản lý gói sản phẩm: CRUD
        1. Controller: admin/PackageController
        2. table: packages
        3. view: admin.package
    */
    Route::resource('/package', 'PackageController');

});

Route::get('/test', function() {
    $input = [
        'username' => 'partner1',
        'email' => 'partner1@gmail.com',
        'password'=>Hash::make('123456'),
    ];
    $id = Partner::create($input)->id;
    dd($id);
});
Route::get('/test/login/partner', function(){
    $input = [
        'username' => 'admin',
        'password' => '123456',
    ];
    // dd(111);
    // $input = [
    //  'username' => 'admin',
    //  'email' => 'admin@gmail.com',
    //  'password'=>Hash::make('123456'),
    // ];
    // $id = Admin::create($input)->id;
    // dd($id);
    $checkLogin = Auth::admin()->attempt($input);
    // $checkLogin = Auth::partner()->attempt($input);
    dd($checkLogin);
});
Route::group(['prefix' => 'partner'], function () {
    // Route::get('/login', array('uses' => 'UserController@login', 'as' => 'admin.login'));
    // Route::post('/login', array('uses' => 'UserController@doLogin'));
    // Route::resource('/', 'UserController');
});
Route::group(['prefix' => 'user'], function () {
    Route::get('/login', array('uses' => 'UserController@login'));
    Route::post('/login', array('uses' => 'UserController@doLogin'));
    Route::get('/logout', 'UserController@logout');
    Route::resource('/', 'UserController');
});


//Route::get('partner/create','PartnerController@create');
//Route::get('partner/display','PartnerController@index');
Route::resource('partner','PartnerController');

//---------------------------------------------------------//

// Route::get('center/create','CenterController@create');
// Route::get('center/display','CenterController@index');
Route::resource('center','CenterController');

// //---------------------------------------------------------//

// Route::get('employees/create','EmployeesController@create');
// Route::get('employees/display','EmployeesController@index');
Route::resource('employees','EmployeesController');


// //---------------------------------------------------------//

// Route::get('class/create','ClassController@create');
// Route::get('class/display','ClassController@index');
// Route::resource('class','ClassController');

// //--------------------------------------------------------//

// Route::get('subject/create','SubjectController@create');
// Route::get('subject/display','SubjectController@index');
// Route::resource('subject','SubjectController');

// //--------------------------------------------------------//

// Route::get('class_subject/create','Class_SubjectController@create');
// Route::get('class_subject/display','Class_SubjectController@index');
// Route::resource('class_subject','Class_SubjectController');

//--------------------------------------------------------//
// Route::post('/ajax/{method}', 'AjaxController@process');
Route::controller('/ajax', 'AjaxController');
// App::error( function(Exception $exception, $code){
//     $pathInfo = Request::getPathInfo();
//     $message = $exception->getMessage() ?: 'Exception';
//     Log::error("$code - $message @ $pathInfo\r\n$exception");
//     switch ($code)
//     {
//         case 403:
//             return View::make('errors.404', array('code' => 403, 'message' => 'Quyền truy cập bị từ chối!'));

//         case 404:
//             return View::make('errors.404', array('code' => 404, 'message' => 'Trang không tìm thấy!'));

//         default:
//             if (Config::get('app.debug')) {
//                 return;
//             }
//     }
// });

