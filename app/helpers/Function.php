
<?php
use Jenssegers\Agent\Agent;
function getCodeDocument($documentId)
{
    // $doc = Document::find($documentId);
    // $version = getVersionDocument($documentId);
    // $type = DocumentType::find($doc->type_id)->code;
    // $class = ClassModel::find($doc->class_id)->code;
    // $subject = Subject::find($doc->subject_id)->code;
    // $level = Level::find($doc->level_id)->code;
    // $numberLesson = Lesson::find($doc->lesson_id)->code;
    // $code = $type.'_'.$class.'_'.$subject.'_'.$level.'_'.$numberLesson.'_'.$documentId.'_'.$version;
    $code = commonGetCodeDocument($documentId);
    return $code;
}
function commonGetCodeDocument($modelId, $modelName = null)
{
    if (!$modelName) {
        $modelName = 'Document';
    }
    $doc = $modelName::find($modelId);
    $version = getVersionDocument($modelId, $modelName);
    $type = DocumentType::find($doc->type_id)->code;
    $class = ClassModel::find($doc->class_id)->code;
    if ($class < 10) {
        $class = '0'.$class;
    }
    $subject = Subject::find($doc->subject_id)->code;
    $level = Level::find($doc->level_id)->code;
    $numberLesson = Lesson::find($doc->lesson_id)->code;
    if ($numberLesson < 10) {
        $numberLesson = '0'.$numberLesson;
    }
    $orderId = getOrderDocument($modelId);
    $code = $type.$subject.$class.'_'.$level.'_'.$numberLesson.'_'.$modelId.$version;
    return $code;
}
function getOrderDocument($modelId, $modelName = null)
{
    if (!$modelName) {
        $modelName = 'Document';
    }
    $orderId = 1;
    return $orderId;
}
function getVersionDocument($documentId, $modelName = null)
{
    return 'A';
}
function getNameTypeId($typeId)
{
    if ($typeId == P) {
        return 'Câu hỏi';
    }
    if ($typeId == D) {
        return 'Đáp án';
    }
}
function getClassByDocument($document)
{
    $classId = $document->class_id;
    $ob = ClassModel::find($classId);
    return $ob->name;
}
function getSubjectByDocument($document)
{
    $subjectId = $document->subject_id;
    $ob = Subject::find($subjectId);
    return $ob->name;
}
function getLevelByDocument($document)
{
    $levelId = $document->level_id;
    $ob = Level::find($levelId);
    return $ob->name;
}
function getRoleAdmin()
{
    $array = [
        '' => '--Chọn quyền--',
        ADMIN => 'Admin',
        BTV => 'BTV' 
    ];
    return $array;
}
function getMethodDefault($classController)
{
    $array = [
        'index' => $classController,
        'create' => $classController,
        'store' => $classController,
        'edit' => $classController,
        'update' => $classController,
        'destroy' => $classController,
        'getPrint' => $classController,
        'getCheckDoc' => $classController,
    ];
    return $array;
}
function checkActiveCheckbox($controllerName, $action, $groupId)
{
    $ob = Permission::where('controller', $controllerName)
        ->where('action', $action)
        ->first();
    if ($ob) {
        $permissionId = $ob->id;
        $relation = RelationPerGroup::where('group_id', $groupId)
            ->where('permission_id', $permissionId)
            ->first();
        if ($relation) {
            return true;
        }
        return false;
    }
    return false;
}
function checkActiveUserPerCheckbox($modelName, $modelId, $groupId, $subjectId)
{
    $ob = AccessPermisison::where('model_name', $modelName)
        ->where('model_id', $modelId)
        ->where('subject_id', $subjectId)
        ->where('group_id', $groupId)
        ->first();
    if (!$ob) {
        return false;
    }
    return true;
}

function renderUrlByPermission($actionOld, $title, $parameter, $att = null)
{
    $url = app('html')->linkAction($actionOld, $title, $parameter, $att);
    $admin = Auth::admin()->get();
    if (isset($admin)) {
        if ($admin->role_id == ADMIN) {
            return $url;
        }
    }
    $array = checkPermission();
    if ($array) {
        $action = explode("@", $actionOld);
        $controllerName = $action[0];
        $method = $action[1];
        $permissionId = null;
        $permission = Permission::where('controller', $controllerName)
            ->where('action', $method)
            ->first();
        $permissionId = null;
        if ($permission) {
            $permissionId = $permission->id;
        }
        if (!$permissionId) {
            return false;
        }
        $subjectId = null;
        if ($action = 'DocumentController') {
            $parentId = $parameter;
            $doc = Document::where('parent_id', $parentId)->first();
            if ($doc) {
                $subjectId = $doc->subject_id;
            }
        }
        $listPermissionUser = getListPermission($subjectId);
        if (!in_array($permissionId, $listPermissionUser)) {
            return false;
        }
        return $url;
    }
    return false;
}

function checkPermission()
{
    //check xem đây là admin
    $admin = Auth::admin()->get();
    if ($admin) {
        $array = [];
        $array['model_name'] = 'Admin';
        $array['model_id'] = $admin->id;
        return $array;
    }
    $user = Auth::user()->get();
    if ($user) {
        $array = [];
        $array['model_name'] = 'User';
        $array['model_id'] = $user->id;
        return $array;
    }
    return false;
    //check xem là user... 
}
function getListPermission($subjectId = null)
{
    $array = checkPermission();
    $list = AccessPermisison::where('model_name', $array['model_name'])
        ->where('model_id', $array['model_id']);
    if (!$subjectId) {
        $list = $list->groupBy('group_id')
            ->lists('group_id');
    } else {
        $list = $list->where('subject_id', $subjectId)
            ->groupBy('group_id')
            ->lists('group_id');
    }
    $listPermision = RelationPerGroup::whereIn('group_id', $list)
        ->groupBy('permission_id')
        ->lists('permission_id');
    return $listPermision;
}
function checkPermissionForm($actionOld, $title, $parameter)
{
    $check = renderUrlByPermission($actionOld, $title, $parameter);
    if ($check) {
        return true;
    }
    return false;
}
function checkUrlPermission($route)
{
    $admin = Auth::admin()->get();
    if (isset($admin)) {
        if ($admin->role_id == ADMIN) {
            return true;
        }
    }
    $array = checkPermission();
    $action = explode("@", $route);
    $controllerName = $action[0];
    $method = $action[1];
    $per = Permission::where('controller', $controllerName)
        ->where('action', $method)
        ->first();
    if (!$per) {
        return false;
    }
    $perId = $per->id;
    $userPer = checkPermission();
    $listGroupId = AccessPermisison::where('model_name', $userPer['model_name'])
        ->where('model_id', $userPer['model_id'])
        ->lists('group_id');
    $count = RelationPerGroup::where('permission_id', $perId)
        ->whereIn('group_id', $listGroupId)
        ->count();
    if ($count == 0) {
        return false;
    }
    return true;
}

function convert_api($src_format, $dst_format, $files, $parameters) {
    $parameters = array_change_key_case($parameters);
    $auth_param = array_key_exists('secret', $parameters) ? 'secret='.$parameters['secret'] : 'token='.$parameters['token'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, "https://v2.convertapi.com/{$src_format}/to/{$dst_format}?{$auth_param}");
    
    if (is_array($files)) {
        foreach ($files as $index=>$file) {
            $parameters["files[$index]"] = file_exists($file) ? new CurlFile($file) : $file;
        }    
    } else {
            $parameters['file'] = file_exists($files) ? new CurlFile($files) : $files;
    }    
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $error = curl_error($curl);
    curl_close($curl);
    if ($response && $httpcode >= 200 && $httpcode <= 299) {
        return json_decode($response);
    } else {
        throw new Exception($error . $response, $httpcode);
    } 
}
function convert_vi_to_en($str) {
      $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
      $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
      $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
      $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
      $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
      $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
      $str = preg_replace("/(đ)/", "d", $str);
      $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
      $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
      $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
      $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
      $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
      $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
      $str = preg_replace("/(Đ)/", "D", $str);
      //$str = str_replace(” “, “-”, str_replace(“&*#39;”,”",$str));
      return $str;
  }
function utf8convert($str) {

                if(!$str) return false;

                $utf8 = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd'=>'đ|Đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

                                                );

                foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);

return $str;

}
function utf8tourl($text){
        $text = strtolower(utf8convert($text));
        $text = str_replace( "ß", "ss", $text);
        $text = str_replace( "%", "", $text);
        $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
        $text = str_replace(array('%20', ' '), '-', $text);
        $text = str_replace("----","-",$text);
        $text = str_replace("---","-",$text);
        $text = str_replace("--","-",$text);
return $text;
}
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
function getStatusDoc($doc)
{
    if ($doc->status == ACTIVE) {
        return 'Đã kiểm duyệt';
    }
    if ($doc->status == INACTIVE) {
        return 'Chưa kiểm duyệt';
    }
}

function getCodeStudentPackage()
{
    $code = null;
    return $code;
}
function getTimeId($time)
{
    $string = $time;
    $timestamp = strtotime($string);
    $day = date("l", $timestamp);
    if ($day == 'Sunday') {
        return CN;
    }
    if ($day == 'Monday') {
        return T2;
    }
    if ($day == 'Tuesday') {
        return T3;
    }
    if ($day == 'Wednesday') {
        return T4;
    }
    if ($day == 'Thursday') {
        return T5;
    }
    if ($day == 'Friday') {
        return T6;
    }
    if ($day == 'Saturday') {
        return T7;
    }
    return false;
}
function getTotalLessonByMoneyPaid($money, $packageId)
{
    $package = Package::find($packageId);
    if (!$package) {
        return false;
    }
    $price = $package->price;
    $totalLesson = round($money/$price);
    return $totalLesson;
}
function getUserIdOfStudent($inputUserId, $manualUser)
{
    if ($manualUser) {
        $user = User::where('username', $manualUser)->first();
        if (!$user) {
            return false;
        }
        $userId = $user->id;
        dd($userId);
        return $userId;
    }
    return $inputUserId;
}
function getPermissionOfManageStudent($value = null)
{
    if ($value) {
        return null;
    }
    $array = [
        GV,
        PTCM
    ];
    return $array;
}
function checkPermissionUserByField($field, $roleId = null)
{
    $admin = Auth::admin()->get();
    if ($admin) {
        return true;
    }
    // dd(111);
    $value = getValueUser($field);
    if ($roleId) {
        if ($value == $roleId) {
            return true;
        }
        return false;
    }
    if (in_array($value, getPermissionOfManageStudent())) {
        return true;
    }
    return false;
}
function getValueUser($field)
{
    $admin = Auth::admin()->get();
    if ($admin) {
        return $value = $admin->$field;
    }
    $user = Auth::user()->get();
    $value = $user->$field;
    return $value;
}
function getCurrentUser()
{
    $user = false;
    if( Auth::admin()->check() ){
        $user = Auth::admin()->get();
    }
    if( Auth::user()->check() ){
        $user = Auth::user()->get();
    }
    return $user;
}
function checkValidatePhoneNumber($number)
{
    if (!is_numeric($number)) {
        return false;
    }
    if ($number < 99999999) {
        return false;
    }
    if ($number > 9999999999) {
        return false;
    }
    return true;
}
function getDevice($device = null)
{
    if(isset($device)) {
        return $device;
    }
    //agent check tablet mobile desktop
    $agent = new Agent();
    if($agent->isMobile() || $agent->isTablet()) {
        return MOBILE;
    } else {
        return COMPUTER;
    }
}


//////////////////////////////// permission ////////////////////////////////////////
function currentUser(){
    $user = false;
    if( Auth::admin()->check() ){
        $user = Auth::admin()->get();
        $user->model = 'Admin';
    }
    else if( Auth::user()->check() ){
        $user = Auth::user()->get();
        $user->model = 'User';
    }
    else if( Auth::partner()->check() ){
        $user = Auth::partner()->get();
        $user->model = 'Partner';
    }
    return $user;
}

function hasRoleAccess($role, $permission){
    $permissions = RolePermission::where('role_slug', $role)->where('permission', $permission)->count();
    if( $permissions > 0 ){
        return true;
    }
    return false;
}

function userAccess($permission, $user = null){
    if( $user == null ){
        $user = currentUser();
    }
    if( hasRole(ADMIN, $user) | hasRole(DEV, $user) ){
        return true;
    }
    $permissions = RolePermission::where('role_slug', $user->role_id)->where('permission', $permission)->count();
    // dd($permissions);
    if( $permissions > 0 ){
        return true;
    }
    return false;
}

function hasRole($roleName, $user = null){
    if( $user == null ){
        $user = currentUser();
    }
    if( !$user ){
        return false;
    }
    if ( $user->role_id == $roleName ){
        return true;
    }
    return false;
}

function renderUrl($action, $title, $parameter = [], $attributes = []){
    $link = '<a href="'.action($action, $parameter).'"'.HTML::attributes($attributes).'>'.$title.'</a>';
    $user = currentUser();
    if( !$user ){
        return false;
    }
    if( hasRole(ADMIN, $user) ){
        return $link;
    }

    $checkPermission = false;
    foreach (getAllPermissions() as $permission => $value) {
        if( userAccess($permission, $user) && in_array($action, $value['accept']) ){
            $checkPermission = $value['accept'];
            break;
        }
    }
    if( $checkPermission ){
        return $link;
    }
    return false;
}

function getAllPermissions(){
    return [
        'system.manage' => [
            'name' => 'Quản trị hệ thống',
            'description' => 'Bao gồm các quyền quản lý đối tác, quản lý trung tâm, quản lý nhân viên, quản lý môn học, lớp học, quản lý thành viên quản trị, phân quyền, Quản lý số lượt tải & lịch sử tải học liệu',
            'accept' => ['AdminController', 'QuantityDownloadController', 'AskPermissionController', 'ManagerPartnerController', 'ClassController', 'SubjectController', 'ManagerCenterController', 'ManagerUserController', 'PermissionController'],
        ],
        'admin.manage' => [
            'name' => 'Quản lý tài khoản Admin',
            'description' => 'Quản lý tất cả tài khoản admin, thêm, sửa, reset password, xóa',
            'accept' => ['AdminController'],
        ],
        'student.manage' => [
            'name' => 'Quản lý học sinh',
            'description' => 'Quản lý tất cả học sinh của tất cả các trung tâm',
            'accept' => ['StudentController'],
        ],
        'student.manage.own' => [
            'name' => 'Quản lý học sinh trong trung tâm',
            'description' => 'Chỉ quản lý học sinh trong trung tâm của mình',
            'accept' => ['StudentController'],
            'callback_function' => '_student_manage_own_center',
        ],
        'student.manage.own.create' => [
            'name' => 'Thêm mới hồ sơ học sinh trong trung tâm',
            'description' => 'Tạo mới hồ sơ học sinh trong trung tâm của mình',
            'accept' => ['StudentController@create', 'StudentController@store'],
            'callback_function' => '_student_create_own_center',
        ],
        'student.manage.own.edit' => [
            'name' => 'Chỉnh sửa hồ sơ học sinh trong trung tâm',
            'description' => 'Chỉnh sửa hồ sơ học sinh bất kỳ trong trung tâm của mình',
            'accept' => ['StudentController@edit', 'StudentController@update'],
            'callback_function' => '_student_edit_own_center',
        ],

        'content.manage' => [
            'name' => 'Quản trị nội dung',
            'description' => 'Bao gồm các quyền quản lý trình độ, quản lý học liệu, upload tài liệu',
            'accept' => ['LevelController', 'DocumentController', 'AdminController@getUploadFile', 'AdminController@postUploadFile', 'ScheduleController'],
        ],
        'schedule.manage' => [
            'name' => 'Quản lý lịch học',
            'description' => 'Bao gồm các quyền quản lý gói học, quản lý lịch học & khóa học',
            'accept' => ['PackageController', 'ScheduleController'],
        ],
        'schedule.create' => [
            'name' => 'Tạo mới lịch học',
            'description' => 'Được phép tạo mới lịch học',
            'accept' => ['ScheduleController@create', 'ScheduleController@store'],
        ],
        'schedule.create' => [
            'name' => 'Tạo mới lịch học',
            'description' => 'Được phép tạo mới lịch học',
            'accept' => ['ScheduleController'],
        ],

        'document.manage' => [
            'name' => 'Quản lý học liệu',
            'description' => 'Quản lý tất cả học liệu, được quyền thêm, sửa, xóa học liệu bất kỳ',
            'accept' => ['DocumentController@index'],
        ],
        'document.view' => [
            'name' => 'Xem học liệu',
            'description' => 'Xem tất cả học liệu',
            'accept' => ['DocumentController@index'],
        ],
        'document.create' => [
            'name' => 'Thêm học liệu',
            'description' => 'Xem tất cả học liệu',
            'accept' => ['DocumentController@create', 'LevelController@show', 'AjaxController@postSaveDocument'],
        ],
        'document.print' => [
            'name' => 'In học liệu',
            'description' => 'In học liệu',
            'accept' => [''],
        ],
        'document.upload_many' => [
            'name' => 'Tải lên nhiều học liệu',
            'description' => 'Được truy cập và tải lên nhiều học liệu một lần',
            'accept' => ['AdminController@getUploadFile'],
        ],

        'level.view' => [
            'name' => 'Xem danh sách trình độ',
            'description' => 'Xem danh sách các trình độ và học liệu của các buổi học',
            'accept' => ['LevelController@show', 'LevelController@index'],
        ],
        'level.edit' => [
            'name' => 'Sửa trình độ',
            'description' => 'Xem danh sách các trình độ, sửa thông tin, thay đổi số buổi học và học liệu của các buổi học',
            'accept' => ['LevelController@show', 'LevelController@index', 'LevelController@edit', 'LevelController@update'],
        ],

    ];
}