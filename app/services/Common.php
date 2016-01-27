<?php
class Common {

	public static function getObject($modelId, $modelName)
	{
		$object = AdminLanguage::where('model_name', $modelName)
			->where('model_id', $modelId)
			->first();
		if ($object) {
			return $object;
		}
		return null;
	}

	public static function getValue($modelId, $modelName, $value)
	{
		return $modelName::find($modelId)->$value;
	}
	public static function getIdEn($id, $modelName)
	{
		$en = self::getObject($id, $modelName);
		if ($en) {
			$idEn = $en->relate_id;
			return $idEn;
		}
		return null;
	}
	public static function deleteLanguage($id, $modelName)
	{
		$relateId = self::getIdEn($id, $modelName);

		if ($relateId) {
			$modelName::find($relateId)->delete();
			$lang = AdminLanguage::where('model_name', $modelName)
				->where('model_id', $id);
			$lang->delete();
		}
		$modelName::find($id)->delete();
	}

	public static function objectLanguage($modelName, $modelId, $lang)
	{
		if ($lang == LANG_VI) {
			return $modelName::find($modelId);

		}
		if ($lang == LANG_EN) {
			$objectLanguage = AdminLanguage::where('model_name', $modelName)
				->where('model_id', $modelId)
				->first();
			$relateId = $objectLanguage->relate_id;
			return $modelName::find($relateId);
		}
	}

	public static function getValueLanguage($modelName, $modelId, $value)
	{
		$objectLanguage = AdminLanguage::where('model_name', $modelName)
			->where('model_id', $modelId)
			->first();
		return $objectLanguage->$value;
	}
	public static function getObjectLanguage($modelName, $lang, $orderBy = null)
	{
		if ($lang == LANG_VI) {
			$listId = AdminLanguage::where('model_name', $modelName)
				->lists('model_id');
			if ($orderBy) {
				$object = $modelName::whereIn('id', $listId)->orderBy($orderBy, 'asc')->get();
			}
			else{
				$object = $modelName::whereIn('id', $listId)->get();
			}
		}
		if ($lang == LANG_EN) {
			$listId = AdminLanguage::where('model_name', $modelName)
				->lists('relate_id');
			$object = $modelName::whereIn('id', $listId)->get();
			if ($orderBy) {
				$object = $modelName::whereIn('id', $listId)->orderBy($orderBy, 'asc')->get();
			}
			else{
				$object = $modelName::whereIn('id', $listId)->get();
			}
		}
		return $object;
	}

	public static function getObjectLanguageByStatus($modelName, $lang, $status=1)
	{
		if ($lang == LANG_VI) {
			$listId = AdminLanguage::where('model_name', $modelName)
				->where('status', $status)
				->orderBy('position')
				->lists('model_id');
			$object = $modelName::whereIn('id', $listId)->get();
		}
		if ($lang == LANG_EN) {
			$listId = AdminLanguage::where('model_name', $modelName)
				->where('status', $status)
				->orderBy('position')
				->lists('relate_id');
			$object = $modelName::whereIn('id', $listId)->get();
		}
		return $object;
	}

	public static function getNews($type, $lang, $limit=null)
	{
		if ($lang == LANG_VI) {
			$list = DB::table('news')
						->join('languages', 'languages.model_id', '=', 'news.id')
						->select('news.id', 'news.type_new_id', 'news.name'
								, 'news.slug', 'news.description', 'news.image_url')
						->where('languages.status', 2)
						->whereNull('news.deleted_at')
						->where('news.type_new_id', $type)
						->distinct()
						->limit($limit)
						->orderBy('languages.position', 'asc')
						->get();
		}
		if ($lang == LANG_EN) {
			$list = DB::table('news')
						->join('languages', 'languages.relate_id', '=', 'news.id')
						->select('news.id', 'news.type_new_id', 'news.name'
								, 'news.slug', 'news.description', 'news.image_url')
						->where('languages.status', 2)
						->whereNull('news.deleted_at')
						->where('news.type_new_id', $type)
						->distinct()
						->limit($limit)
						->orderBy('languages.position', 'asc')
						->get();
		}
		return $list;
	}

	public static function getIdVi($relateId, $relateName)
	{
		$object = AdminLanguage::where('model_name', $relateName)
			->where('relate_id', $relateId)
			->first();
		if ($object) {
			$idVi = $object->model_id;
			return $idVi;
		}
		return $relateId;
	}

	public static function getTypeList($modelName)
	{
		$listTypeId = AdminLanguage::where('model_name', $modelName)
			->lists('model_id');
		return $modelName::whereIn('id', $listTypeId)->lists('name', 'id');
	}

	public static function objectLanguage2($modelName, $modelId, $lang)
	{
		if ($lang == LANG_VI) {
			$objectLanguage = AdminLanguage::where('model_name', $modelName)
				->where('model_id', $modelId)
				->first();
			$relateId = $objectLanguage->relate_id;
			return $modelName::find($relateId);
		}
		if ($lang == LANG_EN) {
			$objectLanguage = AdminLanguage::where('model_name', $modelName)
				->where('relate_id', $modelId)
				->first();
			$modelId = $objectLanguage->model_id;
			return $modelName::find($modelId);
		}
	}

}