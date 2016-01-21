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

}