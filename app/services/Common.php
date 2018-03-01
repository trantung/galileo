<?php
class Common {

    public static function getFreeTimeOfUser($uid, $timeId = null, $startTime = null, $endTime = null){
        $data = [];
        $times = FreeTimeUser::where('user_id', $uid);
        if( $timeId ){
            $times->where('time_id', $timeId);
        }
        if( $startTime ){
            $times->where('start_time', $startTime);
        }
        if( $endTime ){
            $times->where('end_time', $endTime);
        }
        if( $times->count() == 0 ){
            return false;
        }
        foreach ($times->get() as $key => $value) {
            $data[$value->time_id][] = [
                'start_time' => $value->start_time,
                'end_time' => $value->end_time,
            ];
        }
        if( count($data) ){
            return $data;
        }
        return false;
    }

    public static function listFolderFiles($dir){
        if( !is_dir($dir) ){
            return [];
        }
        $ffs = scandir($dir);

        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        // prevent empty ordered elements
        if (count($ffs) < 1){
            
            return [];
        }

        $files = [];
        foreach($ffs as $ff){
            if( !is_dir($dir.'/'.$ff) ){
                $files[] = $dir.'/'.$ff;
            }else{
                $files = array_merge($files, self::listFolderFiles($dir.'/'.$ff));
            }
        }
        return $files;
    }

    /**
     * Lay danh sach level cua 1 User
     */
    public static function getLevelOfUser($uid){
        $levels = UserCenterLevel::where('user_id', $uid)->lists('level_id');
        return $levels;
    }

    /**
     * Lay danh sach Class, Subject, Level cua 1 trung tam
     */
    public static function getClassSubjectLevelOfCenter($centerId){
        $levelsObject = Center::find($centerId);
        $arr = [
            'listClasses' => [],
            'listSubjects' => [],
            'listLevels'    => [],
        ];
        if( count($levelsObject->levels) ){
            foreach ($levelsObject->levels as $level) {
                $arr['listLevels'][] = $level->id;
                if( !isset($arr['listClasses'][$level->class_id]) ){
                    $arr['listClasses'][$level->class_id] = ClassModel::find($level->class_id);
                }
                if( !in_array($level->subject_id, $arr['listSubjects']) ){
                    $arr['listSubjects'][] = $level->subject_id;
                }
            }
        }
        return $arr;
    }

    /**
     * Lay danh sach Level cua 1 mon hoc thuoc 1 lop, tra ve 1 mang
     */
    public static function getLevelBySubject($classId, $subjectId){
        $subjectClass = SubjectClass::where('class_id', '=', $classId)->where('subject_id', '=', $subjectId)->first();
        $subjectClassId = Common::getObject($subjectClass, 'id');
        if( $subjectClassId ){
            $levels = Level::select('id', 'name')->where('subject_class_id', '=', $subjectClassId)->get();
            return $levels;
        }
        return [];
    }

    /**
     * Lay danh sach Level cua 1 mon hoc thuoc 1 lop, tra ve 1 mang
     */
    public static function getSubjectClassByLevel($level){
        $subjectClassId = SubjectClass::findOrFail($level->subject_class_id);
        $classes = ClassModel::findOrFail(Common::getObject($subjectClassId, 'class_id'));
        $subjects = Subject::findOrFail(Common::getObject($subjectClassId, 'subject_id'));
        return ['class'=>$classes,'subject'=>$subjects];
    }

    /**
     * Lay danh sach Level cua 1 mon hoc thuoc 1 lop, tra ve 1 chuoi
     */
    public static function renderLevelBySubject($classId, $subjectId, $separated = ', '){
        $output = [];
        $levels = self::getLevelBySubject($classId, $subjectId);
        if( $levels ){
            foreach ($levels as $key => $value) {
                $output[] = $value->name;
            }
        }
        return implode($separated, $output);
    }

    public static function getValueOfObject($ob, $method, $field, $default = null)
    {
        if (!self::getObject($ob,$method)) {
            return $default;
        }
        if (!($ob->$method->$field)) {
            return $default;
        }
        return $ob->$method->$field;
    }

    public static function getObject($ob, $method, $default = null)
    {
        if (!($ob)) {
            return $default;
        }
        if (!($ob->$method)) {
            return $default;
        }
        return $ob->$method;
    }
    
    public static function checkExist($modelName, $value, $field)
    {
        $check = $modelName::where($field, $value)->first();
        if ($check) {
            return true;
        }
        return false;
    }

    public static function getRoleUser()
    {
        $list = [
            QLTT => 'Quản lý trung tâm',
            GV => 'Giáo vụ',
            PTCM => 'Phụ trách chuyên môn',
            CVHT => 'Cố vấn học tập',
            SALE => 'Bán hàng',
            KT => 'Kế toán',
  
        ];
        return $list;
    }

    public static function getAllCenter()
    {
        $list = Center::lists('name', 'id');
        return $list;
    }

    public static function getExcelLevel($subjectLevels, $classCode)
    {
        foreach ($subjectLevels as $subjectCode => $string) {
            $class = ClassModel::where('code', $classCode)->first();
            $subject = Subject::where('code', $subjectCode)->first();
            if (!$class || !$subject) {
                dd('sai');
            }
            $classId = $class->id;
            $subjectId = $subject->id;
            $subjectClass = SubjectClass::where('class_id', $classId)
                ->where('subject_id', $subjectId)
                ->first();
            if (!$subjectClass) {
                dd('thieu class hoac subject');
            }
            $subjectClassId = $subjectClass->id;
            $array = explode(',', $string);
            foreach ($array as $key => $value) {
                preg_match_all('/(?:^|\s)([^\s])/', $value, $matches);
                $result = $matches[1];
                $result = implode($result);
                // dd($value);
                preg_match('/[0-9]/', $value, $number);
                $result = $result.$number[0];
                $result = strtoupper($result);
                $numberLesson = self::getNumberLesson($result, $classId);
                Level::create([
                    'subject_class_id' => $subjectClassId,
                    'class_id' => $classId,
                    'subject_id' => $subjectId,
                    'code' => $result,
                    'name' => $value,
                    'number_lesson' => $numberLesson,
                ]);
            }
        }
        return true;
    }

    public static function getNumberLesson($levelCode, $classId)
    {
        $arrayHocTot1 = self::getNameGroupLevel(1);
        $arrayHocTot2 = self::getNameGroupLevel(2);
        $arrayMucTieu1 = self::getNameGroupLevel(3);
        $arrayMucTieu2 = self::getNameGroupLevel(4);
        $arrayNenTang1 = self::getNameGroupLevel(5);
        $arrayNenTang2 = self::getNameGroupLevel(6);
        if (in_array($levelCode, $arrayHocTot1)) {
            return $numberLesson = 35;
        }
        if (in_array($levelCode, $arrayHocTot2)) {
            return $numberLesson = 70;
        }
        if (in_array($levelCode, $arrayMucTieu1)) {
            return $numberLesson = 35;
        }
        if (in_array($levelCode, $arrayMucTieu2)) {
            return $numberLesson = 70;
        }
        if (in_array($levelCode, $arrayNenTang1)) {
            if ($classId == 4) {
                return $numberLesson = 10;
            }
            return $numberLesson = 12;
        }
        if (in_array($levelCode, $arrayNenTang2)) {
            if ($classId == 4) {
                return $numberLesson = 16;
            }
            return $numberLesson = 24;
        }
        var_dump($levelCode. '<--->');
    }

    public static function getNameGroupLevel($groupId)
    {
        if ($groupId == 1) {
            return [
                'HTA1', 'HTB1', 'HTC1', 'HTD1', 'HTE1'
            ];
        }
        if ($groupId == 2) {
            return [
                'HTA2', 'HTB2', 'HTC2', 'HTD2', 'HTE2'
            ];
        }
        if ($groupId == 3) {
            return [
                'MTA1', 'MTB1', 'MTC1', 'MTD1', 'MTE1'
            ];
        }
        if ($groupId == 4) {
            return [
                'MTA2', 'MTB2', 'MTC2', 'MTD2', 'MTE2'
            ];
        }
        if ($groupId == 5) {
            return [
                'NTA1', 'NTB1', 'NTC1', 'NTD1', 'NTE1'
            ];
        }
        if ($groupId == 6) {
            return [
                'NTA2', 'NTB2', 'NTC2', 'NTD2', 'NTE2'
            ];
        }

    }

    public static function getDocumentByLesson($lessonId)
    {
        $array = [];
        $parentIds = Document::where('lesson_id', $lessonId)
            ->groupBy('parent_id')
            ->lists('parent_id');
        foreach ($parentIds as $value) {
            $array[$value] = [
                'P' => self::getDocumentObject($value, 1),
                'D' => self::getDocumentObject($value, 2),
            ];
        }
        // dd($array);
        return $array;
    }

    public static function getDocumentObject($parentId, $typeId)
    {
       $ob = Document::where('parent_id', $parentId)
            ->where('type_id', $typeId)
            ->first();
        if ($ob) {
            return $ob;
        }
        return null;
    }

    public static function saveDocument($name, $doc, $arrayP = null)
    {
        $array = [];
        $input = Input::all();
        $doc['type_id'] = ($arrayP) ? D : P;
        if( $_FILES[$name] ){
            foreach ($_FILES[$name]['tmp_name'] as $lessonId => $value) {
                foreach ($value as $k => $v) {
                    if ($arrayP) {
                       $title = $input['doc_new_title_d'][$lessonId][$k];
                    } else {
                        $title = $input['doc_new_title_p'][$lessonId][$k];
                    }
                    $fileUrl = $_FILES[$name]['name'][$lessonId][$k];
                    $fileUrl = DOCUMENT_UPLOAD_DIR.time().'_'.$fileUrl;
                    $doc['name'] = $title;
                    $uploadSuccess = move_uploaded_file($v, public_path().$fileUrl);
                    if( $uploadSuccess ){
                        $doc['file_url'] = $fileUrl;
                        $count = Document::where('lesson_id', $doc['lesson_id'])->count();
                        $doc['order'] = $count + 1;
                        if ($arrayP == null) {
                            $array[$k] = $docId = Document::create($doc)->id;
                            $parentId = $docId;
                        }else{
                            $parentId = $arrayP[$k];
                            $docId = Document::create($doc)->id;
                        }
                        /// Update code after insert document
                        $code = getCodeDocument($docId);
                        Document::find($docId)->update(['code' => $code, 'parent_id' => $parentId]);

                    } // End if
                } // End foreach
            } //End foreach
        } // End if
        if ($arrayP == null) {
            return $array;
        }
        return true;
    }

    public static function getDocument($document, $typeId)
    {
        // dd($document->id);
        $ob = Document::where('parent_id', $document->parent_id)
            ->where('type_id', $typeId)
            ->first();
        if ($ob) {
            return $ob;
        }
        return null;
    }

    public static function getClassList()
    {
        return ClassModel::orderBy('created_at', 'desc')->lists('name','id');
    }

    public static function getSubjectList()
    {
        return Subject::orderBy('created_at', 'desc')->lists('name','id');
    }

    public static function getLevelDropdownList($name, $default = null)
    {
        $levels = Level::orderBy('created_at', 'desc')->get();
        $html = '<select name="'. $name .'" class="form-control">
            <option value="">--Tất cả--</option>';
        foreach ($levels as $key => $value) {
            $html .= '<option '. (($value->id == $default) ? 'selected' : (( $value->class_id != Input::get('class_id') | $value->subject_id != Input::get('subject_id')) ? 'class="hidden"' : '')) .' class-id="'. $value->class_id .'" value="'. $value->id .'" subject-id="'. $value->subject_id .'">'. $value->name .'</option>';
        }
        $html .= '<select>';
        return $html;
    }

    public static function getLevelMultiDropdownList($name, $levels = [], $default = null)
    {
        $html = '<select name="'. $name .'" class="form-control" multiple>
            <option value="">--Tất cả--</option>';
        foreach ($levels as $key => $value) {
            $html .= '<option '. ( ($value->id == $default) ? 'selected' : '' ) .' class-id="'. $value->class_id .'" value="'. $value->id .'" subject-id="'. $value->subject_id .'">'. $value->subjects->name.' '.$value->name .'</option>';
        }
        $html .= '<select>';                                                                            
        return $html;
    }

    public static function getModelNameByController($controllerName)
    {
        if ($controllerName == 'SubjectController') {
            return 'Subject';
        }
        if ($controllerName == 'DocumentController') {
            return 'Document';
        }

    }
    public static function getMethodLevel()
    {
        return ['index', 'show'];
    }
    public static function getFileNameConvert($fileName, $input)
    {
        // dd($fileName);

        // PT04_HTB1_01_1A
        //loại bỏ chũ docx ở cuối file;
        if (strstr($fileName, 'docx')) {
            $fileName = str_replace('.docx', "", $fileName);
        }
        $fileName = str_replace('.', '_', $fileName);
            $typeId = self::getTypeDocByName($fileName, $input);
            if ($typeId == P) {
                $type = 'P';
            }
            if ($typeId == D) {
                $type = 'D';
            }
            $subject = self::getSubjectDocByName($fileName, $input);
            $class = self::getClassDocByName($fileName, $input);
            $ob = ClassModel::where('code', $input['class'])->first();
            if ($ob) {
                $classId = $ob->id;
            } else {
                $classId = 0;
            }
            
            $level = self::getLevelDocByName($fileName, $input);
            $numberLesson = self::getNumberLessonDocByName($fileName, $input);
            $docId = '';
            $version = self::getVersionDocByName($fileName);
            //luu vao db với code = null;
            $levelId = self::getLevelId($level, $classId, 2, $input);
            $lessonId = self::getLessonId($levelId, $classId, 2, $numberLesson);
            if ($numberLesson < 10) {
                $numberLessonText = '0'.$numberLesson;
            } else {
                $numberLessonText = $numberLesson;
            }
            $code = $type.$subject.$class.'_'.$level.'_'.$numberLessonText.'_'.$docId.$version;

            $doc['file_url'] = DOCUMENT_UPLOAD_DIR.$code.'.docx';
            $doc['code'] = $code;
            $doc['type_id'] = $typeId;
            $doc['class_id'] = $classId;
            $doc['subject_id'] = 2;
            $doc['level_id'] = $levelId;
            $doc['lesson_id'] = $lessonId;
            $doc['parent_id'] = 0;
            $docId = Document::create($doc)->id;

            //update document
            if ($typeId == P) {
                $parentId = $docId;
            }
            if ($typeId == D) {
                $docP = Document::where('level_id', $levelId)
                    ->where('class_id', $class)
                    ->where('subject_id', 2)
                    ->where('lesson_id', $lessonId)
                    ->where('type_id', P)
                    ->first();
                if ($docP) {
                    $parentId = $docP->id;
                } else {
                    $parentId = null;
                }
            }
            $code = $type.$subject.$class.'_'.$level.'_'.$numberLessonText.'_'.$docId.$version;
            $fileUrl = DOCUMENT_UPLOAD_DIR.$input['class'].'/'.$input['subject'].'/'.$input['level_code'].'/'.$code.'.pdf';
            Document::find($docId)->update([
                'file_url' => $fileUrl,
                'code' => $code,
                'parent_id' => $parentId,
            ]);
            return $type.$subject.$class.'_'.$level.'_'.$numberLessonText.'_'.$docId.$version;
            // $array = explode("_", $fileName);
            // dd($array);
            // foreach ($array as $key => $value) {
            //     $test = clean($value);
            //     $test = strtolower($test);
            //     if (strstr($test, 'buoi')) {
            //         $test1 = explode("-", $test);
            //         $a = array_search('buoi', $test1);
            //         $numberLesson = $test1[$a+1];
            //         dd($numberLesson);
            //         return $numberLesson;
            //     }
            // }
            // dd($fileName);
            
    }
    public static function getTypeDocByName($fileName, $input)
    {   
        $array = explode("_", $fileName);
        foreach ($array as $key => $value) {
            $test = utf8convert($value);
            $test = strtolower($test);
            if (strstr($test, 'an')&&strstr($test, 'ap')) {
                return D;
            }
            if (strstr($test, 'phi')) {
                return P;
            }
            if (strstr($test, 'an')) {
                return D;
            }
        }
        dd($fileName);
        // return P;
    }
    public static function getSubjectDocByName($fileName, $input)
    {
        return $input['subject'];
        $array = explode("_", $fileName);
        foreach ($array as $key => $value) {
            $test = utf8convert($value);
            $test = strtolower($test);
            if (strstr($test, 'van')) {
                return 'V';
            }
            if (strstr($test, 'toan')) {
                return 'T';
            }
        }
        return '';
    }
    public static function getClassDocByName($fileName, $input)
    {
        if ($input['class'] < 10) {
            return '0'.$input['class'];
        }
        return $input['class'];
        $ob = ClassModel::where('code', $input['class'])->first();
        if ($ob) {
            return $ob->id;
        }
        return 0;
    }
    public static function getLevelDocByName($fileName, $input)
    {
        return $input['level_code'];
    }
    public static function getNumberLessonDocByName($fileName)
    {
        $array = explode("_", $fileName);
        foreach ($array as $key => $value) {
            $test = utf8convert($value);
            $test = strtolower($test);
            if (strstr($test, 'buoi')) {
                $test1 = explode("-", $test);
                if (count($test1) > 0) {
                   $a = array_search('buoi', $test1);
                    $numberLesson = $test1[$a+1];
                    return $numberLesson;
                }
                
            }
        }
        return 0;
    }
    public static function getIdDocByName($fileName)
    {
        $id = 1;
        return $id;
    }
    public static function getVersionDocByName($fileName)
    {
        return 'A';
    }
    public static function getLevelId($code, $classId, $subjectId)
    {
        $level = Level::where('code', $code)
            ->where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->first();
        if ($level) {
            return $level->id;
        }
        return 0;
    }
    public static function getLessonId($levelId, $classId, $subjectId, $numberLesson)
    {
        $lesson = Lesson::where('level_id', $levelId)
            ->where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->where('code', $numberLesson)
            ->first();
        if ($lesson) {
            return $lesson->id;
        }
        return 0;
    }
    public static function getListLessonCode()
    {
        $lesson = Lesson::groupBy('code')->orderBy('code', 'asc')->lists('code','code');
        // dd($lesson);
        usort($lesson, function($a, $b){
            if( (int)$a > (int)$b ) {
                return 1;
            }
            return -1;
        });
        $array = [];
        foreach ($lesson as $key => $value) {
            $array[$value] = $value;
        }
        return $array;
    }
    public static function permissionDoc($modelName, $modelId, $input)
    {
        AccessPermisison::where('model_name', $modelName)
            ->where('model_id', $modelId)
            ->delete();
        if (isset($input['permission'])) {
            $permission = $input['permission'];
            foreach ($permission as $subjectId => $value) {
                foreach ($value as $groupId => $v) {
                    $access = [];
                    $access['subject_id'] = $subjectId;
                    $access['model_name'] = $modelName;
                    $access['model_id'] = $modelId;
                    $access['group_id'] = $groupId;
                    AccessPermisison::create($access);
                }
            }
        }
        return true;
    }
    public static function getCenterByUser($userId)
    {
       $centerLevel = UserCenterLevel::where('user_id', $userId)
            ->groupBy('center_level_id')
            ->lists('center_level_id');
        $listCenter = CenterLevel::whereIn('id', $centerLevel)->groupBy('center_id')->lists('center_id');
        $name = '';
        foreach ($listCenter as $key => $value) {
            $center = Center::find($value);
            $name .= $name.$center->name.',';
        }
        return $name;
    }
    public static function getNameGender($gender)
    {
        if ($gender == NAM) {
            return 'Nam';
        }
        if ($gender == NU) {
            return 'Nữ';
        }
    }

    public static function getPackageDropdownList($name, $packages = [], $default = null)
    {
        $html = '<select name="'. $name .'" class="form-control" required>
            <option value="">-- Chọn --</option>';
        foreach ($packages as $key => $value) {
            $html .= '<option '. ( ($value->id == $default) ? 'selected' : '' ) .' number-lesson="'. $value->lesson_per_week .'" value="'. $value->id .'">'. $value->name .'<p>-</p>'.$value->lesson_per_week.' buổi/tuần<p>-</p>'.$value->total_lesson.' buổi<p>-thời lượng </p>'.$value->duration.' phút<p>-tối đa </p>'.$value->max_student.' học sinh</option>';
        }
        $html .= '<select>';                                                                            
        return $html;
    }

    public static function getParentPhone($id){
        $family = Common::getObject(Student::find($id), 'families');
        if( count($family) == 0 ){
            return false;
        }
        if( Common::getObject($family[0], 'phone') ){
            return Common::getObject($family[0], 'phone');
        }
        if( Common::getObject($family[1], 'phone') ){
            return Common::getObject($family[1], 'phone');
        }
        return false;
    }
}