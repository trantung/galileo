<?php

class ClassController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = ClassModel::all();
        return View::make('admin.class.index')->with(compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $subjects = Common::getSubjectList();
        return View::make('admin.class.create')->with(compact('subjects'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        // dd($input);
        $classId = CommonNormal::create($input);
        if($classId){
            // Lay cac record moi them trong bang subject_class
            // Chua validate cac subject trung nhau
            CommonNormal::attach($classId, 'subjects', $input['subject']);
            $subjectClasses = CommonNormal::getListRelateObject('SubjectClass', $classId, 'class_id');
            foreach ($subjectClasses as $subjectClass) {
                $subjectId = $subjectClass->subject_id;
                // Neu nhu mon hoc nay co nhap input "trinh do"
                if( isset($input['level'][$subjectId]) ){
                    foreach ($input['level'][$subjectId] as $level) {
                        if( !empty($level) ){
                            /* Lay tat ca trinh do cua lop hoc moi them tai moi mon hoc tuong ung
                             * de them vao bang level
                             */
                            CommonNormal::create( ['name' => $level, 'subject_class_id' => $subjectClass->id], 'Level');
                        }
                    }
                }
            }
        }
        return Redirect::action('ClassController@index')->withMessage('Lưu thành công');
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
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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
