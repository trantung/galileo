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
            $data2->whereBetween('lesson_date', [ $now, date('Y-m-d', strtotime($now.' + '.(8 - $timeId).' days')) ]);
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
        $center = Center::lists('name', 'id');
        $students = Student::lists('fullname', 'id');
        $student = [];
        foreach ($students as $id => $name) {
            $student[$id] = $name.' - '.Common::getParentPhone($id);
        }
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
        $data = StudentPackage::all();
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
