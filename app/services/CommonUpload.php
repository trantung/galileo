<?php
use Carbon\Carbon;
class CommonUpload
{
	/**
	*uploadImage Upload image
	*/

	public static function uploadImage($id, $path, $imageUrl, $folder, $image = NULL)
	{
		$destinationPath = public_path().'/'.$path.'/'.$folder.'/'.$id.'/';
		if(Input::hasFile($imageUrl)){
			$file = Input::file($imageUrl);
			$filename = $file->getClientOriginalName();
			$uploadSuccess = $file->move($destinationPath, $filename);
			return $filename;
		}
		if ($image) {
			return $image;
		}
	}

	public static function getNameTypeSlide($type)
	{
		if ($type == SLIDE_TOP) {
			return 'Banner';
		}
		if ($type == SLIDE_BOTTOM) {
			return 'Đối tác';
		}

	}

}