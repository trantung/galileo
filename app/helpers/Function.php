<?php
function getCodeDocument($documentId)
{
    $doc = Document::find($documentId);
    $version = getVersionDocument($documentId);
    $type = DocumentType::find($doc->type_id)->code;
    $class = ClassModel::find($doc->class_id)->code;
    $subject = ClassModel::find($doc->subject_id)->code;
    $level = ClassModel::find($doc->level_id)->code;
    $numberLesson = Lesson::find($doc->lesson_id)->code;
    $code = $type.'_'.$class.'_'.$subject.'_'.$level.'_'.$numberLesson.'_'.$documentId.'_'.$version;
    return $code;
}

function getVersionDocument($documentId)
{
    return 1;
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
    return Role::lists('name', 'id');
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