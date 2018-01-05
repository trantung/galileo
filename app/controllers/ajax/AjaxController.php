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

}
