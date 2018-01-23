<?php
class SubjectController extends AdminController implements AdminInterface {

    public function __construct() {
        parent::__construct();
        $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Subject::all();
        return View::make('admin.subject.index')->with(compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.subject.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        CommonNormal::create($input);
        return Redirect::back()->withMessage('Save successful!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Subject::findOrFail($id);
        return View::make('admin.subject.edit')->with(compact('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();
        CommonNormal::update($id, $input);
        return Redirect::action('SubjectController@index')->withMessage('Save successful!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Subject::destroy($id);
        return Redirect::action('SubjectController@index')->withMessage('Save successful!');
    }


}
