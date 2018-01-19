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
    ];
    return $array;
}
function checkActiveCheckbox($controllerName, $action, $groupId)
{
    $ob = Permission::where('controller', $controllerName)
        ->where('action', $action)
        ->where('group_id', $groupId)
        ->first();
    if ($ob) {
        return true;
    }
    return false;
}
function checkActiveUserPerCheckbox($modelName, $modelId, $groupId, $subjectId)
{
    $listPer = Permission::where('group_id', $groupId)->lists('id');
    $ob = AccessPermisison::where('model_name', $modelName)
        ->where('model_id', $modelId)
        ->where('subject_id', $subjectId)
        ->whereIn('permission_id', $listPer)
        ->get();
    if (count($ob) > 0) {
        return true;
    }
    return false;
}

function renderUrlByPermission($actionOld, $title, $parameter, $att = null)
{

    $array = checkPermission();
    if ($array) {
        $action = explode("@", $actionOld);
        $controllerName = $action[0];
        $method = $action[1];
        $permissionId = null;
        $permission = Permission::where('controller', $controllerName)
            ->where('action', $method)
            ->first();
        if ($permission) {
            $permissionId = $permission->id;
        }
        $subjectId = null;
        if ($action = 'DocumentController') {
            $parentId = $parameter;
            $doc = Document::where('parent_id', $parentId)->first();
            $subjectId = $doc->subject_id;
        }
        $listPermission = getListPermission($subjectId);
        if (!$permissionId) {
            return false;
        }
        if (!in_array($permissionId, $listPermission)) {
            return false;
        }
        $url = app('html')->linkAction($actionOld, $title, $parameter, $att);
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
    return false;
    //check xem là user... 
}
function getListPermission($subjectId = null)
{
    $array = checkPermission();
    $list = AccessPermisison::where('model_name', $array['model_name'])
        ->where('model_id', $array['model_id']);
    if (!$subjectId) {
        $list = $list->groupBy('permission_id')
            ->lists('permission_id');
    } else {
        $list = $list->where('subject_id', $subjectId)
            ->groupBy('permission_id')
            ->lists('permission_id');
    }
    return $list;
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
    if ($admin->role_id == ADMIN) {
        return true;
    }
    $action = explode("@", $route);
    $controllerName = $action[0];
    $method = $action[1];
    $listPer = Permission::where('controller', $controllerName)
        ->where('action', $method)
        ->lists('id');
    if (count($listPer) == 0) {
        return false;
    }
    $access = AccessPermisison::where('model_name', 'Admin')
        ->where('model_id', $admin->id)
        ->whereIn('permission_id', $listPer)
        ->get();
    if (count($access) == 0) {
        return false;
    }
    return true;
}