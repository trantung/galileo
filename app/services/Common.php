<?php
class Common {
    
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