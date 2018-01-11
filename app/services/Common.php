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
    public static function getExcelLevel()
    {
    	$string = '
    		Học tốt A1, Học tốt B1, Học tốt C1, Học tốt D1, Học tốt E1, Nền tảng A1, Nền tảng B1, Nền tảng C1, Nền tảng D1, Nền tảng E1, Mục tiêu A1, Mục tiêu B1, Mục tiêu C1, Mục tiêu D1,Mục tiêu E1
    	';
    	$array = explode(',', $string);
    	return $array;
    }	
    
}