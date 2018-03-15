<?php

class ScheduleController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Input::all();
        $data2 = SpDetail::orderBy('lesson_date', 'ASC')->orderBy('lesson_hour', 'ASC');

        //// Neu chua co tim kiem nao thi hien thi mac dinh cac ket qua tu ngay hien tai den cuoi tuan
        if( empty($input) ){
            $now = date( 'Y-m-d', time() );
            $timeId = getTimeId( $now );
            $data2->whereBetween('lesson_date', [ $now, date('Y-m-d', strtotime($now.' + '.(CN - $timeId).' days')) ]);
        }
        
        if( !empty($input['class_id']) ){
            $data2->where('class_id', $input['class_id']);
        }
        if( !empty($input['subject_id']) ){
            $data2->where('subject_id', $input['subject_id']);
        }
        if( !empty($input['level_id']) ){
            $data2->where('level_id', $input['level_id']);
        }
        if( !empty($input['user_id']) ){
            $data2->where('user_id', $input['user_id']);
        }
        
        if( !empty($input['start_date']) && !empty($input['end_date']) ){
            $data2->whereBetween('lesson_date', [ $input['start_date'], $input['end_date'] ]);
        }
        if( !empty($input['phone']) ){
            $families = Family::where('phone', trim($input['phone']))->get();
            if( count($families) == 0 ){
                $data2->where('student_id', '00');
            }
            foreach ($families as $key => $family) {
                if( count($family->students) ){
                    foreach ($family->students as $key2 => $student) {
                        $data2->where('student_id', $student->id);
                    }
                }else{
                    $data2->where('student_id', '00');
                }
            }
        }

        $data = [];
        foreach ($data2->get() as $key => $value) {
            $data[$value->lesson_date][] = $value;
        }
        $data2 = $data2->paginate(PAGINATE);
        return View::make('admin.schedule.list')->with(compact('data', 'data2'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(){
        $package = Package::all();
        $class = ClassModel::lists('name', 'id');
        $subject = Subject::lists('name', 'id');
        $level = Level::lists('name', 'id');
        $user = Auth::user()->get();
        if (!$user) {
            return Redirect::action('UserController@login');
        }
        $userId = $user->id;
        $listCenterId = UserCenterLevel::where('user_id', $userId)->lists('center_id');
        $center = Center::whereIn('id', $listCenterId)->lists('name', 'id');
        
        $students = Student::lists('fullname', 'id');
        $userActive = User::where('role_id', CVHT)->lists('username', 'id');
        $userNameActive = User::where('role_id', CVHT)->lists('username');
        return View::make('admin.schedule.create')->with(compact('class', 'subject', 'level', 'center','package', 'student','userActive', 'userNameActive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function course()
    {
        $input = Input::all();
        
        $data = StudentPackage::orderBy('code', 'ASC');

        if( !empty($input['class_id']) ){
            $data->where('class_id', $input['class_id']);
        }
        if( !empty($input['subject_id']) ){
            $data->where('subject_id', $input['subject_id']);
        }
        if( !empty($input['level_id']) ){
            $data->where('level_id', $input['level_id']);
        }
        if( !empty($input['package_id']) ){
            $data->where('package_id', $input['package_id']);
        }
        $data = $data->paginate(PAGINATE);
        return View::make('admin.schedule.course')->with(compact('data'));
    }

    public function store()
    {
        $input = Input::all();
       
        // dd($input);
        //create record in table: student_package
        $studentPackageInput = Input::only(
            'center_id', 'class_id', 'subject_id', 'level_id',
            'package_id', 'lesson_code', 'money_paid'
        );
        if (!isset($studentPackageInput['lesson_code'])) {
            $studentPackageInput['lesson_code'] = 1;
        }
        if (!isset($input['user_id'])) {
            $input['user_id'] = null;
        }

        $studentPackageInput['student_id'] = $input['student_id'];
        $studentPackageInput['center_id'] = $input['center_id'];
        // $studentPackageInput['time_id'] = getTimeId($input['time_id']);
        $studentPackageInput['lesson_total'] = getTotalLessonByMoneyPaid($input['money_paid'], $input['package_id']);
        //$studentPackageInput['code'] = getCodeStudentPackage();
        $studentPackageId = StudentPackage::create($studentPackageInput)->id;
        // StudentPackage::update('id', $studentPackageId, 'StudentPackage');
        StudentPackage::find($studentPackageId)->update(['code' => $studentPackageId]);
        //create record in table: student_level
        //create record in table: detail
        $lessonDate = [];
        for ($i=0; $i < $studentPackageInput['lesson_total']; $i++) { 
            foreach ($input['time_id'] as $key => $value) {
                if ($value != '' && count($lessonDate) < $studentPackageInput['lesson_total']) {
                    $number = $i*7;
                    $text = ' + '.$number.' days';
                    $lessonDate[] = [date('Y-m-d', strtotime($value.$text)), $input['hours'][$key]];
                }
            }
        }
        for ($i=0; $i < $studentPackageInput['lesson_total']; $i++) { 
            $spDetailInput = Input::only(
                'class_id', 'subject_id', 'level_id',
                'package_id'
            );
            $spDetailInput['student_id'] = $input['student_id'];
            $spDetailInput['student_package_id'] = $studentPackageId;
            $spDetailInput['time_id'] = getTimeId($lessonDate[$i][0]);
            $spDetailInput['user_id'] = $input['user_id'];
            $spDetailInput['center_id'] = $input['center_id'];
            $spDetailInput['class_id'] = $input['class_id'];
            $spDetailInput['subject_id'] = $input['subject_id'];
            $spDetailInput['level_id'] = $input['level_id'];
            $spDetailInput['package_id'] = $input['package_id'];
            $spDetailInput['status'] = REGISTER_LESSON;
            $spDetailInput['lesson_code'] = $studentPackageInput['lesson_code'] + $i;
            $spDetailInput['lesson_date'] = $lessonDate[$i][0];
            $spDetailInput['lesson_hour'] = $lessonDate[$i][1];
            $idSpDetail = SpDetail::create($spDetailInput)->id;
        }
        return Redirect::action('ScheduleController@index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function documentLink($lessonId, $studentId)
    {   
        $documents = Document::where('lesson_id', $lessonId)
            ->groupBy('parent_id')
            ->get();
        return View::make('admin.schedule.document_link')->with(compact('documents', 'lessonId', 'studentId'));
    }


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
    public function updatecourse($id)
    {
        
    }

    public function update($id)
    {
    	$input = Input::except('_token');
    	$spDetail = SpDetail::find($id);
    	$spDetail->update($input);
    	return Redirect::action('ScheduleController@index');
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
    public function postAdditional($id, $studentId)
    {
        $input = Input::all();
        // dd($input['doc_new_file_p']);
        $doc['lesson_id'] = $id;
        $doc['student_id'] = $studentId;
        if (Auth::admin()->get()) {
            $doc['user_id'] = null;
        } else {
            $doc['user_id'] = getValueUser('id');
        }
        $lesson = Lesson::find($id);
        $levelId = $lesson->level_id;
        $doc['level_id'] = $lesson->level_id;
        $doc['subject_id'] = $lesson->subject_id;
        $doc['class_id'] = $lesson->class_id;
        $doc['status'] = 1;

        $subjectCode = SubjectClass::find($lesson->subject_id)->code;
        $classCode = ClassModel::find($lesson->class_id)->code;
        $levelCode = Level::find($lesson->level_id)->code;
        $lessonCode = $lesson ->code;
        $link = $subjectCode.'/'.$classCode.'/'.$levelCode.'/'.$lessonCode.'/';
        foreach ($input['doc_new_file_p'] as $key => $value) {
            $docAdditionalId = DocumentAdditional::create($doc)->id;
        
            $destinationPath = public_path().'/'.DOCUMENT_UPLOAD_ADDITIONAL.'/'.$link.'/'.$studentId.'/';
            $filename = $value->getClientOriginalName();
            $uploadSuccess = $value->move($destinationPath, $filename);


            // $fileUrl = CommonUpload::uploadImage($studentId, DOCUMENT_UPLOAD_ADDITIONAL, 'doc_new_file_p', $link);
            // CommonNormal::update($docAdditional, ['file_url' => $input['file_url']] );
            $docAdditional = DocumentAdditional::find($docAdditionalId);
            $docAdditional->update(['file_url' => $filename]);

        }
        dd(3333);



        $doc['code'] = $levelId;
        $doc['file_url'] = $levelId;
        $doc['order'] = $levelId;
        $doc['type_id'] = $levelId;
        $doc['parent_id'] = $levelId;

        $arrayP = Common::saveDocument('doc_new_file_p', $doc);
        Common::saveDocument('doc_new_file_d', $doc, $arrayP);

    }


    public function courseEdit($id){
        $input = Input::all();
        $old = StudentPackage::find($id);
        $input['code'] = $old->code;
        $old->delete();
        StudentPackage::create($input);
        return Redirect::action('ScheduleController@course')->withMessage('Lưu thành công!');
    }
}
