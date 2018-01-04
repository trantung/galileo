<?php
use Carbon\Carbon;
class CommonNormal
{
	public static function attach($id, $name = null, $relateModel, $input){
		$name = self::commonName($name);
		$model = $name::find($id);
		// dd($model);
		if( !method_exists($model, $relateModel) ){
			return null;
		}

		// Them record vao bang many_many
		$model->$relateModel()->attach($input);

		// Lay ten bang many_many
		$pivotTable = $model->$relateModel()->getTable();
		// lay ten truong ma khoa chinh cua Model $name la khoa ngoai cua bang many_many
		$foreignKey = $model->$relateModel()->getForeignKey();
		// $otherKey = $model->$relateModel()->getOtherKey();
		if( !empty($pivotTable) && !empty($foreignKey) ){
			/// Tra ve 1 mang cac record vua insert trong bang many_many
			return DB::table($pivotTable)->where($foreignKey, $id)->get();
		}
		return null;
	}

	public static function delete($id, $name)
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
		} else{
			return $name;
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
	}
}