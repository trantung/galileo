<?php
class Common {

	public static function getSubjectList(){
		return Subject::lists('subject_name', 'id');
	}

	public static function getValueOfObject($ob, $method, $field)
	{
		if (!($ob)) {
			return null;
		}
		if (!($ob->$method)) {
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