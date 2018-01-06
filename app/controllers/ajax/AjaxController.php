<?php 
class AjaxController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function process()
	{
		$input = Input::all();
		return Response::json($input);
	}
	public function postDelete()
	{
		$input = Input::all();
		$ob = SubjectClass::where('class_id', $input['class_id'])
			->where('subject_id', $input['subject_id']);
		$listId = $ob->lists('id');
		Level::whereIn('id', $listId)->delete();
		$ob->delete();
			// ->list();

		return Response::json($input);
	}
}
