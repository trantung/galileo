<?php
use Carbon\Carbon;
class CommonNormal
{
	public static function relateAction($id, $relateMethod, $input, $method = 'attach', $name = null){
		$name = self::commonName($name);
		$model = $name::find($id);
		// dd($model);
		if( !method_exists($model, $relateMethod) ){
			return null;
			dd($model . 'chưa khai báo quan hệ' . ':' . $relateMethod);
		}
		// Them record vao bang many_many
		$model->$relateMethod()->$method($input);
		return true;
		// SubjectClass::where('class_id', $id)->lists('id');
		// Lay ten bang many_many
		// $pivotTable = $model->$relateMethod()->getTable();
		// // lay ten truong ma khoa chinh cua Model $name la khoa ngoai cua bang many_many
		// $foreignKey = $model->$relateMethod()->getForeignKey();
		// // $otherKey = $model->$relateMethod()->getOtherKey();
		// if( !empty($pivotTable) && !empty($foreignKey) ){
		// 	/// Tra ve 1 mang cac record vua insert trong bang many_many
		// 	return DB::table($pivotTable)->where($foreignKey, $id)->get();
		// }
		// return null;
	}

	public static function delete($id, $name = NULL)
	{
		$name = self::commonName($name);
		$name::find($id)->delete();
	}

	public static function update($id, $input, $name = NULL)
	{
		$name = self::commonName($name);
		$name::find($id)->update($input);
	}
	
	public static function create($input, $name = NULL)
	{
		$name = self::commonName($name);
		$id = $name::create($input)->id;
		return $id;
	}

	public static function commonName($name = NULL)
	{
		if ($name == NULL) {
			$name = Request::segment(2);
		} 
		if ($name == 'subject') {
			return 'Subject';
		}
		if ($name == 'partner') {
			return 'Partner';
		}
		if ($name == 'class') {
			return 'ClassModel';
		}
		if ($name == 'user') {
			return 'User';
		}
		if ($name == 'level') {
			return 'Level';
		}
		if ($name == 'doc') {
			return 'Document';
		}
		if ($name == 'center') {
			return 'Center';
		}
		return $name;
	}
	public static function getListRelateObject($modelName, $value, $field)
	{
		$list = $modelName::where($field, $value)->get();
		return $list;
	}
	public static function createOrUpdateSubjectLevel($classId, $input)
	{
		self::relateAction($classId, 'subjects', $input['subject']);
        $subjectClasses = self::getListRelateObject('SubjectClass', $classId, 'class_id');
        foreach ($subjectClasses as $subjectClass) {
            $subjectId = $subjectClass->subject_id;
            // Neu nhu mon hoc nay co nhap input "trinh do"
            if( isset($input['level'][$subjectId]) ){
                foreach ($input['level'][$subjectId] as $level) {
                    if( !empty($level) ){
                        /* Lay tat ca trinh do cua lop hoc moi them tai moi mon hoc tuong ung
                         * de them vao bang level
                         */
                        self::create( ['name' => $level, 'subject_class_id' => $subjectClass->id], 'Level');
                    }
                }
            }
        }
        return true;
	}

}