<?php

class PermissionController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Common::getRoles();
        return View::make('permission.list')->with(compact('roles'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function show()
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
        $input = Input::all();
        DB::table('role_permission')->truncate();
        foreach ($input['permission'] as $permission => $roles) {
            foreach ($roles as $roleSlug => $value) {
                RolePermission::create(['role_slug' => $roleSlug, 'permission' => $permission]);
            }
        }
        return Redirect::back()->withMessage('Lưu thành công');
        // dd($input);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return Response
    //  */
    // public function listRole()
    // {
    //     $data = Role::all();
    //     return View::make('role.index')->with(compact('data'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return Response
    //  */
    // public function createRole()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return Response
    //  */
    // public function storeRole()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return Response
    //  */
    // public function destroyRole()
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editRole($role)
    {
        $role = Role::findBySlug($role);
        $data = RolePermission::where('role_slug', $role->code)->get();
        return View::make('permission.detail')->with(compact('data', 'role'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateRole($role)
    {
        $input = Input::all();
        RolePermission::where('role_slug', $role)->delete();
        foreach ($input['permission'] as $permission => $roles) {
            foreach ($roles as $roleSlug => $value) {
                RolePermission::create(['role_slug' => $roleSlug, 'permission' => $permission]);
            }
        }
        return Redirect::back()->withMessage('Lưu thành công');
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
        // $input = Input::all();
        // // dd($input);
        // AccessPermisison::where('model_name', 'Admin')
        //     ->where('model_id', $adminId)
        //     ->delete();
        
        // if (isset($input['permission'])) {
        //     $permission = $input['permission'];
        //     foreach ($permission as $subjectId => $value) {
        //         foreach ($value as $groupId => $v) {
                    
        //             $listPerIds = Permission::where('group_id', $groupId)
        //                 ->lists('id');
        //             $access = [];
        //             $access['subject_id'] = $subjectId;
        //             $access['model_name'] = 'Admin';
        //             $access['model_id'] = $adminId;
        //             foreach ($listPerIds as $k => $permissionId) {
        //                 $access['permission_id'] = $permissionId;
        //                 AccessPermisison::create($access);
        //             }
        //         }
        //     }
        // }
        // return Redirect::action('PermissionController@edit', $adminId);
    }
}
