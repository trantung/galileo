<?php
class Common {

    public static function getFreeTimeOfUser($uid, $timeId = null, $startTime = null, $endTime = null){
        $data = [];
        $times = FreeTimeUser::where('user_id', $uid);
        if( $timeId ){
            $times->where('time_id', $timeId);
        }
        if( $startTime ){
            $times->where('start_time', '<=', $startTime);
        }
        if( $endTime ){
            /// Thoi gian ket thuc 1 ca day cua CVHT phai sau thoi gian dang kys
            $times->where('end_time', '>=', $endTime);
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
        // dd($centerId);
        $arr = [
            'listClasses' => [],
            'listSubjects' => [],
            'listLevels'    => [],
        ];
        if( $levelsObject && count($levelsObject->levels) ){
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
     * Lay danh sach Class, Subject, Level cua 1 trung tam
     */
    public static function getClassSubjectLevel(){
        $arr = [
            'listClasses' => [],
            'listSubjects' => [],
            'listLevels'    => [],
        ];
        foreach (self::getAllLevel() as $level) {
            $arr['listLevels'][] = $level->id;
            if( !isset($arr['listClasses'][$level->class_id]) ){
                $arr['listClasses'][$level->class_id] = $level->classes;
            }
            if( !isset($arr['listSubjects'][$level->subject_id]) ){
                $arr['listSubjects'][$level->subject_id] = $level->subjects;
            }
        }
        return $arr;
    }

    /**
     * Lay danh sach Level cua 1 mon hoc thuoc 1 lop, tra ve 1 mang
     */
    public static function getLevelBySubject($classId, $subjectId){
        if( !Cache::has('level_subject_class_'.$subjectId.'_'.$classId) ){
            $levels = Level::select('id', 'name')
                ->where('subject_id', '=', $subjectId)
                ->where('class_id', '=', $classId)->get();
            if($levels == null){
                $levels = [];
            }
            Cache::put('level_subject_class_'.$subjectId.'_'.$classId, $levels, 100);
        }
        return Cache::get('level_subject_class_'.$subjectId.'_'.$classId);
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

    public static function getRoleAdmin()
    {
        $list = [
            DEV => 'Nhà phát triển',
            ADMIN => 'Quản trị viên',
            BTV => 'Biên tập viên',
        ];
        return $list;
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

    public static function getRoleName($role)
    {
        if($role == DEV){
            return 'Nhà phát triển';
        }
        if($role == ADMIN){
            return 'Quản trị viên';
        }
        if($role == BTV){
            return 'Biên tập viên';
        }
        if($role == QLTT){
            return 'Quản lý trung tâm';
        }
        if($role == GV){
            return 'Giáo vụ';
        }
        if($role == PTCM){
            return 'Phụ trách chuyên môn';
        }
        if($role == CVHT){
            return  'Cố vấn học tập';
        }
        if($role == SALE){
            return  'Nhân viên Sale';
        }
        if($role == KT){
            return  'Kế toán';
        }
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
                'P' => self::getDocumentObject($value, P),
                'D' => self::getDocumentObject($value, D),
            ];
        }
        // dd($array);
        return $array;
    }
    public static function getDocumentByParentId($parentId, $type)
    {
       $doc = Document::where('parent_id', $parentId)->where('type_id', $type)->first();
        if ($doc) {
            return $doc;
        }
        return null;
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
        if( !Cache::has('all_class_list') ){
            Cache::put('all_class_list', ClassModel::orderBy('created_at', 'desc')->lists('name','id'), 60);
        }
        return Cache::get('all_class_list');
    }

    public static function getAllClass()
    {
        if( !Cache::has('get_class_list') ){
            Cache::put('get_class_list', ClassModel::all(), 60);
        }
        return Cache::get('get_class_list');
    }

    public static function getSubjectList()
    {
        if( !Cache::has('all_subject_list') ){
            Cache::put('all_subject_list', Subject::orderBy('created_at', 'desc')->lists('name','id'), 60);
        }
        return Cache::get('all_subject_list');
    }

    public static function getLevelDropdownList($name, $default = null, $classId = null, $subjectId = null)
    {
        if( empty($classId) ){
            $classId = Input::get('class_id');
        }
        if( empty($subjectId) ){
            $subjectId = Input::get('subject_id');
        }
        $levels = Level::orderBy('created_at', 'desc')->get();
        $html = '<select name="'. $name .'" class="form-control">
            <option value="">--Tất cả--</option>';
        foreach ($levels as $key => $value) {
            $html .= '<option '. (($value->id == $default) ? 'selected' : (( $value->class_id != $classId | $value->subject_id != $subjectId) ? 'class="hidden"' : '')) .' class-id="'. $value->class_id .'" value="'. $value->id .'" subject-id="'. $value->subject_id .'">'. $value->name .'</option>';
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

    public static function getListCenter(){
        if( !Cache::has('list_all_center') ){
            Cache::put('list_all_center', Center::lists('name', 'id'), 30);
        }
        return Cache::get('list_all_center');
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
        $user = User::find($userId);
        $name = [];
        if( $user && count($user->centers) ){
            foreach ($user->centers as $key => $center) {
                $name[] = $center->name;
            }
        }
        return implode($name, ', ');
    }

    public static function getCenterOfLoggedUser(){
        if( Auth::user()->check() ){
            $user = Auth::user()->get();
            return $user->centers()->lists('center_id');
        }
        return null;
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
    public static function getStudentList()
    {
        if ( !Cache::has('student_list') ){
            $students = Student::orderBy('created_at', 'DESC')->lists('fullname', 'id');
            $student = [];
            foreach ($students as $id => $name) {
                $student[$id] = $name.' - '.Common::getParentPhone($id);
            }
            Cache::put('student_list', $student, 15);
        }
        $student = Cache::get('student_list');
        
        return $student;
    }

    public static function getNameStudentList()
    {
        return Student::orderBy('created_at', 'desc')->lists('fullname', 'id');
    }

    public static function getEmailStudentList()
    {
        return Student::orderBy('created_at', 'desc')->lists('email','id');
    }


    public static function getLessonIdByLessonCodeLevel($lessonCode, $levelId ){
        $lesson = Lesson::where('level_id', $levelId)->where('code', $lessonCode)->first();
        if( $lesson ){
            $lessonId = $lesson->id;
            return $lessonId;
        }
        return null;
     }

    public static function getStartDate($id)
    {
        $startDate = SpDetail::where('student_package_id', $id)->orderBy('lesson_code', 'ASC')->first();
        return self::getObject($startDate, 'lesson_date');
    }
    
    public static function resetPassAdminOrUser()
    {

        $admin = Auth::admin()->get();
        if(!$admin){
            $user = Auth::user()->get();
            return $user->id;
        }
        return $admin->id;
    }

    public static function getScheduleOfStudentPackage($packageId){
        // if ( !Cache::has('schedule_of_course_'.$packageId) ){
            return SpDetail::where('student_package_id', $packageId)
             ->orderBy('lesson_date', 'ASC')
             ->groupBy('time_id')
             ->get();
            // $student = [];
            // foreach ($schedule as $id => $name) {
            //     $students[$id] = $name.' - '.Common::getParentPhone($id);
            // }
            // Cache::put('schedule_of_course_'.$packageId, $schedules, 1);
        // }
        // $schedules = Cache::get('schedule_of_course_'.$packageId);
        
        // return $schedules;
    }

    public static function getTimeIdList(){
        return [
            T2 => 'Thứ hai',
            T3 => 'Thứ ba',
            T4 => 'Thứ tư',
            T5 => 'Thứ năm',
            T6 => 'Thứ sáu',
            T7 => 'Thứ bảy',
            CN => 'Chủ nhật',
        ];
    }

    public static function getCVHTList()
    {
        return User::where('role_id', CVHT)->lists('username', 'id');
    }

    public static function checkCreateOrUpdateDocAdd($lessonId, $studentId)
    {
        $count = DocumentAdditional::where('lesson_id', $lessonId)
            ->where('student_id', $studentId)
            ->count();
        if ($count > 0) {
            return true;
        }
        return false;
    }

    public static function getDocAdd($lessonId, $studentId, $typeId, $order)
    {
        $ob = DocumentAdditional::where('lesson_id', $lessonId)
            ->where('student_id', $studentId)
            ->where('type_id', $typeId)
            ->where('order', $order)
            ->first();
        if ($ob) {
            return $ob;
        }
        return null;
    }

    public static function getUserCenterList()
    {
        $user = getCurrentUser();
        if ($user) {
            $userCenterList = UserCenterLevel::where('center_id', $user->id)->get();
        }
        return $userCenterList;
    }
    
    public static function explodeDocumentName($name){
        return [
            'type' => substr($name, 0, 1),
            'subject_code' => substr($name, 1, 1),
            'class_code' => (int)substr($name, 2, 2),
            'level_code' => (isset(explode('_', $name)[1]) ? explode('_', $name)[1] : ''),
            'lesson_code' => (isset(explode('_', $name)[2]) ? explode('_', $name)[2] : ''),
        ];
    }


    //  hàm kiểm soát số lượng download (chưa đúng)
    public static function checkQuantityDownload($document)
    {
        if (Auth::admin()->get()) {
            return true;
        }
        $documentId = $document->id;
        $now = date("Y-m-d");
        $quantityDownload = QuantityDownload::where('level_id', $document->level_id)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->first();
        if (!$quantityDownload) {
            return true;
        }
        $maxDoc = $quantityDownload->max_document;
        $maxAcc = $quantityDownload->max_account;
        $docLogs = DocumentLog::where('model_name', 'User')
            ->where('document_id', $document->id)
            ->where('created_at', '>', $quantityDownload->start_time)
            ->where('created_at', '<', $quantityDownload->end_time)
            ->count();
        if ($docLogs < $maxDoc) {
            if ($user = Auth::user()->get()) {
                $modelId = $user->id;
                $maxAccDoc = DocumentLog::where('model_name', 'User')
                    ->where('model_id', $modelId)
                    ->where('level_id', $document->level_id)
                    ->count();
                if ($maxAccDoc < $maxAcc) {
                    return true;
                }
                return false;
            }
            return true;
        }
        return false;
    }

    public static function checkedCheckbox($document)
    {
        if($document->status == 1){
            return 'checked';
        }
        return null;
    }


    // Hàm kiểm tra số lượt download khi limit
    public static function AskPermission($documentId)
    {
        $check = Auth::admin()->get();
        if ($check) {
            return true;
        }
        $check = Auth::user()->get();
        if (!$check) {
            return false;
        }

        $userId = $check->id;
        $countRecord = DocumentLog::where('model_name', 'User')
            ->where('model_id', $check->id)
            ->where('document_id', $documentId)
            ->count();
        $now = date("Y-m-d");

        $document = Document::find($documentId);
        $quantityDownload = QuantityDownload::where('level_id', $document->level_id)
            ->where('start_time', '<', $now)
            ->where('end_time', '>', $now)
            ->first();
        if (!$quantityDownload) {
            return true;
        }
        $maxDoc = $quantityDownload->max_document;
        $maxAcc = $quantityDownload->max_account;
        //kiểm tra maxdoc và số lượng bản ghi với doc_id trong documentlog có nhiều hơn ko
        if ($countRecord >= $maxDoc) {
            return false;
        }
        //kiểm tra maxacc và số lượng bản ghi với doc_id trong documentlog có nhiều hơn ko đối với 1 acc
        $countRecordAcc = DocumentLog::where('model_name', 'User')
            ->where('model_id', $check->id)
            ->count();
        if ($countRecordAcc >= $maxAcc) {
            return false;
        }
        //kiểm tra lịch dạy của cvht
        if (in_array($check->role_id, [CVHT, PTCM, GV])) {
            //lấy lịch dạy của cvht
            $timeIdCVHT = FreeTimeUser::where('user_id', $userId)->lists('time_id');
            if (count($timeIdCVHT) == 0) {
                return false;
            }
            //kiểm tra time_id trong lịch dạy có phải là hôm nay không, nếu không phải hôm nay thì return false
            $time = date( 'Y-m-d', time());
            $dayNumber = getTimeId($time);
            if (!in_array($dayNumber, $timeIdCVHT)) {
                return false;
            }
            //nếu now mà < thời gian bắt đầu - 1 khoảng thời gian(2 tiếng) thì false
            $beforeHour = date('H:i:s', strtotime('-2 hours'));
            $afterHour = date('H:i:s', strtotime('+2 hours'));
            $currentHour = date('H:i:s');

            
            $hour1 = FreeTimeUser::where('user_id', $userId)
                ->where('time_id', $dayNumber)
                ->where('start_time', '>', $beforeHour)
                ->where('start_time', '<', $afterHour)
                ->count();
            if($hour1 > 0){
                return true;
            }
            $hour2 = FreeTimeUser::where('user_id', $userId)
                ->where('end_time', '<', $beforeHour)
                ->count();
            if ($hour2 > 0) {
                return false;
            }

            $hour3 = FreeTimeUser::where('user_id', $userId)
                ->where('start_time', '>', $afterHour)
                ->count();
            if ($hour3 > 0) {
                return false;
            }
        }
        return true;
    }


    /**
     * Get list Level via session
     */
    public static function getListLevel(){
        if( !Cache::has('list_all_level') ){
            Cache::put('list_all_level', Level::lists('name', 'id'), 30 );
        }
        return Cache::get('list_all_level');
    }

    /**
     * Get list Level via session
     */
    public static function getAllLevel(){
        if( !Cache::has('get_all_level') ){
            Cache::put('get_all_level', Level::all(), 30 );
        }
        return Cache::get('get_all_level');
    }

    public static function getRoles()
    {
        $list = Role::lists('name', 'code');
        if( count($list) == 0 ){
            return self::getRoleAdmin() + self::getRoleUser();
        }
        return $list;
    }
}