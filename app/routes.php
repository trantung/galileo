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
Route::get('/test/insertdb/T', 'TestController@insert');
Route::get('/test/insertdb/V', 'TestController@insertVan');
Route::get('/test/updatedb', 'TestController@updatedb');
Route::get('/test/updatedb/T', 'TestController@updatedbT');
Route::get('/test/import', 'TestController@import');
Route::controller('/test', 'TestController');

Route::resource('/', 'AdminController');
    
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

Route::get('/', 'AdminController@index');
Route::group(['prefix' => 'admin'], function () {
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
    
    Route::resource('student', 'StudentController');
    /*
        Quản lý partner: CRUD đối tác: tên, email, username, password, sđt
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
    Route::resource('/user', 'ManagerUserController');
    Route::resource('/', 'AdminController');

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
    Route::resource('/', 'UserController');
});
Route::group(['prefix' => 'user'], function () {
    // Route::get('/login', array('uses' => 'UserController@login', 'as' => 'admin.login'));
    // Route::post('/login', array('uses' => 'UserController@doLogin'));
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


App::error( function(Exception $exception, $code){
    $pathInfo = Request::getPathInfo();
    $message = $exception->getMessage() ?: 'Exception';
    Log::error("$code - $message @ $pathInfo\r\n$exception");
    switch ($code)
    {
        case 403:
            return View::make('errors.404', array('code' => 403, 'message' => 'Quyền truy cập bị từ chối!'));

        case 404:
            return View::make('errors.404', array('code' => 404, 'message' => 'Trang không tìm thấy!'));

        default:
            if (Config::get('app.debug')) {
                return;
            }
    }
});

