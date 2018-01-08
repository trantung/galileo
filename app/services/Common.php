<?php
class Common {

	/**
	 * Lay danh sach cac quyen da khai bao trong helpers/Constant, tra ve 1 mang
	 */
	public static function getListRole(){
		return [
			QLTT 	=> 'Quản lý trung tâm',
			GV 		=> 'Giáo vụ',
			PTCM 	=> 'Phụ trách chuyên môn',
			CVHT 	=> 'Cố vấn học tập',
			SALE 	=> 'Bán hàng',
			KT 		=> 'Kế toán',
		];
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
}