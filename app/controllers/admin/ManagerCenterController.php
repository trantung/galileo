<?php
class ManagerCenterController extends AdminController implements AdminInterface{

    public function __construct() {
        parent::__construct();
        // $this->beforeFilter('admin', array('except'=>array('login','doLogin')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $centers = Center::all();   
        return View::make('admin.center.index')->with(compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $listClasses = ClassModel::all();
        $listPartners = Partner::lists('name', 'id');
        $listLevels = Level::lists('name', 'id');
        return View::make('admin.center.create')->with(compact('listPartners', 'listClasses', 'listLevels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::except('_token');
        // dd($input);
        
        $centerId = Center::create($input)->id;
        if( !empty($input['level']) && $centerId ){
            CommonNormal::relateAction($centerId, 'levels', $input['level']);
        }
        return Redirect::action('ManagerCenterController@index');
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
        $center = Center::find($id);
        $partnerId = $center->partner_id;
        $listPartners = Partner::lists('name', 'id');
        $listClasses = ClassModel::all();
        $listLevels = [];
        if( count($center->levels) ){
            foreach ($center->levels as $value) {
                $listLevels[$value->id] = Common::getSubjectClassByLevel($value);
            }
        }
        // dd($listLevels);
        return View::make('admin.center.edit')->with(compact('center', 'partnerId', 'listPartners', 'listClasses', 'listLevels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::except('_token', '_method');
        $center = Center::findOrFail($id);
        $center->update($input);
        if( !empty($input['level']) ){
            CommonNormal::relateAction($id, 'levels', $input['level'], 'sync');
        }
        return Redirect::action('ManagerCenterController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        CommonNormal::delete($id);
        return Redirect::action('ManagerCenterController@index');
    }

}

