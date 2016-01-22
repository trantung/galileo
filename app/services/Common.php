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
}