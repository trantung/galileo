<?php
class NewsManager
{
	public static function searchNews($input)
	{
		$data = AdminNew::where(function ($query) use ($input)
		{
			if ($input['type_new_id'] != 0) {
				$query = $query->where('type_new_id', $input['type_new_id']);
			}
			if ($input['name']) {
				$query = $query->where('name', 'like', '%'.$input['name'].'%');
			}
			// if($input['start_date'] != ''){
			// 	$query = $query->where('start_date', '>=', $input['start_date']);
			// }
			// if($input['end_date'] != ''){
			// 	$query = $query->where('start_date', '<=', $input['end_date']);
			// }
		})->orderBy('id', 'desc')->paginate(PAGINATE);
		return $data;
	}

	public static function getTypeNews()
	{
		$listTypeId = AdminLanguage::where('model_name', 'TypeNew')
			->lists('model_id');
		return TypeNew::whereIn('id', $listTypeId)->lists('name', 'id');
	}

}