<?php
class Common {

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

    public static function getSubjectList(){
        return Subject::lists('name', 'id');
    }

    public static function getValueOfObject($ob, $method, $field)
    {
        if (!self::getObject($ob,$method)) {
            return null;
        }
        if (!($ob->$method->$field)) {
            return null;
        }
        return $ob->$method->$field;
    }

    public static function getObject($ob, $method)
    {
        if (!($ob)) {
            return null;
        }
        if (!($ob->$method)) {
            return null;
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
}