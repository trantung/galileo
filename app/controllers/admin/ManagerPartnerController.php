<?php
class ManagerPartnerController extends AdminController implements AdminInterface{
    public function __construct() {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $partners = Partner::all(); 
        return View::make('admin.partner.index')->with(compact('partners'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.partner.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::except('_token');
        //check username da ton tai hay chua
        $check = Common::checkExist('Partner', $input['username'], 'username');
        if ($check) {
            $message = 'Tồn tại username của partner';
            return View::make('admin.partner.create')->with(compact('message'));
        }
        //tao moi
        $input['password'] = Hash::make($input['password']);
        $partnerId = Partner::create($input)->id;
        return Redirect::action('ManagerPartnerController@index');
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
        $partner = Partner::find($id);
        return View::make('admin.partner.edit')->with(compact('partner'));
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
        $partner = Partner::find($id);
        $partner->update($input);
        return Redirect::action('ManagerPartnerController@index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Partner::find($id)->delete();
        return Redirect::action('ManagerPartnerController@index');
    }
    public function getResetPass($id)
    {
        return View::make('admin.partner.reset_password')->with(compact('id'));
    }
    public function postResetPass($id)
    {
        $input = Input::all();
        $partner = Partner::find($id);
        $password = Hash::make($input['password']);
        $partner->update(['pass' => $password]);
        return Redirect::action('ManagerPartnerController@index');

    }

}

