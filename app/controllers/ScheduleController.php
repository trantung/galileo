<?php

class ScheduleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::action('ScheduleController@create');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
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
	public function store()
	{
        $input = Input::all();
		// dd($input);
        //create record in table: student_package
        $studentPackageInput = Input::only(
            'class_id', 'subject_id', 'level_id',
            'package_id', 'lesson_code', 'money_paid'
        );
        $studentPackageInput['student_id'] = $input['student_id'];
        // $studentPackageInput['time_id'] = getTimeId($input['time_id']);
        $studentPackageInput['lesson_total'] = getTotalLessonByMoneyPaid($input['money_paid'], $input['package_id']);
        $studentPackageInput['code'] = getCodeStudentPackage();
        $studentPackageId = StudentPackage::create($studentPackageInput)->id;
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
        return Redirect::back()->withMessage('Lưu thành công');
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
