<?php

class PermissionController extends \BaseController {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
        $admin = Admin::find($id);
        return View::make('admin.permission.edit')->with(compact('admin'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($adminId)
    {
        $input = Input::all();
        // dd($input);
        AccessPermisison::where('model_name', 'Admin')
            ->where('model_id', $adminId)
            ->delete();
        
        if (isset($input['permission'])) {
            $permission = $input['permission'];
            
            foreach ($permission as $subjectId => $value) {
                foreach ($value as $groupId => $v) {
                    
                    $listPerIds = Permission::where('group_id', $groupId)
                        ->lists('id');
                    $access = [];
                    $access['subject_id'] = $subjectId;
                    $access['model_name'] = 'Admin';
                    $access['model_id'] = $adminId;
                    foreach ($listPerIds as $k => $permissionId) {
                        $access['permission_id'] = $permissionId;
                        AccessPermisison::create($access);
                    }
                }
            }
        }
        return Redirect::action('PermissionController@edit', $adminId);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
