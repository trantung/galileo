<?php
class Common { 								//hàm kiểm tra có dữ liệu này ở trong bảng partner hay không
	public static function getObject($object = null, $val = ''){
		if( $object == null ){				//nếu không có đối tượng
			return null;					//trả về null
		} elseif( !isset($object->$val) ){	//nếu có đối tượng nhưng không có name của đối tượng 
			return null;					//thì cũng hiển thị null 
		}
		return $object->$val;				//ngược lại trả về name
	}
}