<?php
class ClassController extends AdminController implements AdminInterface {
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
            CommonNormal::relateAction($classId, 'subjects', $input['subject']);
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
                            CommonNormal::create( [
                                'name' => $level, 
                                'subject_class_id' => $subjectClass->id,
                                'class_id' => $classId,
                                'subject_id' => $subjectId,
                            ], 'Level');
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
        $data = ClassModel::findOrFail($id);
        $subjects = Common::getSubjectList();
        // dd(count($data->subjects));
        return View::make('admin.class.edit')->with(compact('subjects', 'data'));
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
        ClassModel::find($id)->update($input);
        $levels = !empty($input['level']) ? $input['level'] : [];
        $listLevelId = [];
        $listSubjectClassId = SubjectClass::where('class_id', $id)->lists('id');
        $list = Level::whereIn('subject_class_id', $listSubjectClassId)->lists('id');
        foreach ($levels as $key => $value) {
            $listLevelId[] = array_keys($value);
        }
        $listLevelId = call_user_func_array('array_merge', $listLevelId);
        // $levelToUpdate = $listLevelId;

        foreach ($levels as $k => $v) {
            foreach ($v as $keyV => $valueV) {
               $ob = Level::find($keyV);
               if ($ob) {
                   $ob->update(['name' => $valueV]);
               }
            }
        }
        $levelToDelete = array_diff($list, $listLevelId);
        Level::whereIn('id', $levelToDelete)->delete();
        if (isset($input['level_new'])) {
            $inputNew = $input['level_new'];
            foreach ($inputNew as $keyNew => $valueNews) {
                $subjectClass = SubjectClass::where('class_id', $id)->where('subject_id', $keyNew)->first();
                $subjectClassId = $subjectClass->id;
                foreach ($valueNews as $valueNew) {
                    Level::create([
                        'name' => $valueNew, 
                        'subject_class_id' => $subjectClassId,
                        'class_id' => $id,
                        'subject_id' => $keyNew,
                    ]);
                }
            }
        }
        if (isset($input['subject'])) {
            foreach ($input['subject'] as $valueSubject) {
                $subjectClassNewId = SubjectClass::create([
                    'subject_id' => $valueSubject,
                    'class_id' => $id,
                ])->id;
                $listLevel = $input['level'][$valueSubject];
                foreach ($listLevel as $keyL => $valueL) {
                    Level::create([
                        'name' => $valueL, 
                        'subject_class_id' => $subjectClassNewId,
                        'class_id' => $id,
                        'subject_id' => $valueSubject,
                    ]);
                }
            }
            
        }
        return Redirect::back()->withMessage('Lưu thành công');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        ClassModel::destroy($id);
        return Redirect::action('ClassController@index')->withMessage('Lưu thành công');
    }
}
