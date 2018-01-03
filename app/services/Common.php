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
}