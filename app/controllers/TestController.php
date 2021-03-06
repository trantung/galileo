<?php

class TestController extends AdminController implements AdminInterface {


    public function getImportFreeTimeUser(){
        Excel::load('public/CVHT.xlsx', function($reader){
            $results = $reader->toArray();
            $frame = [
                1 => ['start_time' => '08:00:00','end_time' => '10:00:00',],
                2 => ['start_time' => '10:00:00','end_time' => '12:00:00',],
                3 => ['start_time' => '13:30:00','end_time' => '15:30:00',],
                4 => ['start_time' => '15:30:00','end_time' => '17:30:00',],
                5 => ['start_time' => '17:00:00','end_time' => '19:00:00',],
                6 => ['start_time' => '19:00:00','end_time' => '21:00:00',]
            ];
            foreach( $results as $key1 => $item){
                $userName1 = $item['username'];
                $userName = 'toan'.'.'.$userName1;
                $user = User::where('username', $userName)->first();
                if( empty($user) ){
                    $user = User::create([
                        'username' => $userName,
                        'email' => $userName1.'@galileo.edu.vn',
                        'password' => Hash::make('123456'),
                        'role_id' => CVHT
                    ]);
                }
                foreach ($item as $key2 => $value) {
                    if( strtolower($value) == 'x' ){
                        $arr = explode('_', $key2);
                        $check = FreeTimeUser::where('user_id', $user->id)
                            ->where('time_id', $arr[0])
                            ->where('start_time', $frame[$arr[1]]['start_time'])
                            ->where('end_time', $frame[$arr[1]]['end_time'])
                            ->where('status', 1)->count();
                        if($check == 0){
                            $field = $frame[$arr[1]];
                            $field['time_id'] = $arr[0];
                            $field['user_id'] = $user->id;
                            $userId = FreeTimeUser::create($field)->id;
                        }
                    }
                }
            }
        });
        return 'test';
    }

    public function getImportStudent(){
        Excel::load('public/students.xlsx', function($reader){
            $results = $reader->toArray();
            $countInsert = $countUpdate = $countFalse = 0;
           
            foreach ($results as $key => $value) {
                 $groupId = null;
                $momId = null;
                if(!empty($value['ho_va_ten_hoc_sinh'])){
                    // if( empty($value['sdt_me']) && empty($value['sdt_bo']) ){
                    //     /////////// neu khong co bo me thi bo qua
                    //     // var_dump($value['ho_va_ten_hoc_sinh']);
                    //     // var_dump('-----');
                    //     // $countFalse++;
                    //     continue;
                    // }

                    /////////////// Luu thong tin me trong bang family
                    if($value['sdt_me']){
                        
                        $fieldMom = [
                            'fullname' => !empty($value['ho_va_ten_me']) ? $value['ho_va_ten_me'] : '',
                            'phone' => !empty($value['sdt_me']) ? $value['sdt_me'] : '',
                            'gender' => 0
                        ];
                        $check = Family::where('phone', $fieldMom['phone'])->first();
                        if (!$check) {
                            $momId = Family::create($fieldMom)->id;
                            $family = Family::find($momId);
                            $family->update(['group_id' => $momId]);
                            $groupId = $momId;
                        } 
                        // $momId = Common::getObject(Family::where('phone', $fieldMom['phone'])->first(), 'id');

                        // if($momId){
                        //     $fieldMom['group_id'] = $momId;
                        //     CommonNormal::update($momId, $fieldMom, 'Family');
                        // }
                        // else{
                        //     $momId = CommonNormal::create($fieldMom, 'Family');
                        // }

                        // $groupId = $momId;
                        // $fieldMom['group_id'] = $groupId;
                        // ///// lay Id cua me lam groupId
                        // CommonNormal::update($momId, $fieldMom, 'Family');
                    }

                    //////////// Luu thong tin cua bo vao Family
                    if($value['sdt_bo']){
                        $fieldDad = [
                            'fullname' => !empty($value['ho_va_ten_bo']) ? $value['ho_va_ten_bo'] : '',
                            'phone' => !empty($value['sdt_bo']) ? $value['sdt_bo'] : '',
                            'gender' => 1
                        ];
                        $checkDad = Family::where('phone', $fieldDad['phone'])->first();
                        if (!$checkDad) {
                            if ($momId) {
                                // dd($value);
                                $fieldDad['group_id'] = $momId;
                                $dadId = Family::create($fieldDad)->id;
                            }
                            else {
                                // dd(555);
                                $dadId = Family::create($fieldDad)->id;
                                $familyDad = Family::find($dadId);
                                $familyDad->update(['group_id' => $dadId]);
                                $groupId = $dadId;
                            }
                            // $family = Family::find($momId);
                            // $family->update(['group_id' => $momId]);
                        } 
                        // $dadId = Common::getObject(Family::where('phone', $fieldDad['phone'])->first(), 'id');

                        // if($dadId){
                        //     CommonNormal::update($dadId, $fieldDad, 'Family');
                        // }
                        // else{
                        //     $dadId = CommonNormal::create($fieldDad, 'Family');
                        // }

                        // ////// Neu nhu khong co me thi lay id cua bo lam groupId
                        // if( !isset($groupId) ){
                        //     $groupId = $dadId;
                        // }
                        // $fieldDad['group_id'] = $groupId;
                        // CommonNormal::update($dadId, $fieldDad, 'Family');
                    }
                    // dd('----');
                    // dd(5555);
                    //////////// Luu thong tin hoc sinh
                    $field = [
                        'fullname' => !empty($value['ho_va_ten_hoc_sinh']) ? $value['ho_va_ten_hoc_sinh'] : '',
                        'code' => !empty($value['ma_hs']) ? $value['ma_hs'] : '',
                        'date_study' => !empty($value['ngay_nhap_hoc']) ? $value['ngay_nhap_hoc']->toDateTimeString() : '',
                        'birthday' => is_object($value['ngay_sinh']) ? $value['ngay_sinh']->toDateTimeString() : '',
                        'gender' => !empty($value['gioi_tinh']) ? (strtolower($value['gioi_tinh']) == 'nam' ? 1 : 0) : '', 
                        'address' => !empty($value['dia_chi_hien_tai']) ? $value['dia_chi_hien_tai'] : '',
                        'model_name' => !empty($value['nguon']) ? $value['nguon'] : '',
                        'school' => !empty($value['truong_hoc']) ? $value['truong_hoc'] : '',
                        'email' => !empty($value['email_nhan_thong_tin']) ? $value['email_nhan_thong_tin'] : '',
                        'link_fb' => !empty($value['link_fb_ph']) ? $value['link_fb_ph'] : '',
                        'description' => !empty($value['muc_tieu_sau_khi_hoc_tai_trung_tam']) ? $value['muc_tieu_sau_khi_hoc_tai_trung_tam'] : '',
                        'time_target' => !empty($value['thoi_gian_can_dat_muc_tieu']) ? $value['thoi_gian_can_dat_muc_tieu'] : '',
                        'info_user' => !empty($value['thong_tin_nguoi_don']) ? $value['thong_tin_nguoi_don'] : '',
                        'comment' => !empty($value['luu_y_ve_hoc_sinh']) ? $value['luu_y_ve_hoc_sinh'] : '',
                    ];
                    $studentId = Common::getObject(Student::where('email', $field['email'])->first(), 'id');
                    if($studentId){
                        CommonNormal::update($studentId, $field, 'Student');
                        $countUpdate++;
                    }
                    else{
                        $studentId = CommonNormal::create($field, 'Student');
                        $field['family_id'] = $groupId;
                        if ($studentId) {
                            CommonNormal::update($studentId, $field, 'Student');
                            $countInsert++;
                        } else {
                            echo $field['email'].'------';
                        } 
                        //////////// Lay groupId cua bo hoac me lam familyId
                        
                    }
                }
                else {
                    var_dump('ma hoc sinh:'. $value['ma_hs']);
                    var_dump('------------');
                }
            } //End foreach

            echo 'Đã tạo mới: '.$countInsert.'<br>Đã cập nhật: '.$countUpdate.'<br/>'.'sai:'.$countFalse;
        });
    }

    public function getImportTUser(){
        Excel::load('public/CTV_T.xlsx', function($reader) {
            $results = $reader->toArray();
            $centerId = Center::first()->id;
            $centerLevels = CenterLevel::where('center_id', $centerId)->get();
            $subjectId = Subject::where('code', 'T')->first()->id;
            // dd($subjectId);
            $countInsert = $countUpdate = 0;
            foreach ($results as $key => $value) {
                if( !empty( $value['email_galileo'] ) ){
                    $field = [
                        'full_name' => !empty($value['ho_ten_day_du']) ? $value['ho_ten_day_du'] : '',
                        'email' => !empty($value['email_galileo']) ? $value['email_galileo'] : '',
                        'start_date' => !empty($value['ngay_bat_dau_lam']) ? $value['ngay_bat_dau_lam']->toDateTimeString() : '',
                        'birth_day' => is_object($value['ngay_sinh']) ? $value['ngay_sinh']->toDateTimeString() : '',
                        'phone' => !empty($value['so_dien_thoai']) ? '0'.$value['so_dien_thoai'] : '',
                        'current_address' => !empty($value['noi_o_hien_tai']) ? $value['noi_o_hien_tai'] : '',
                        'address' => !empty($value['dia_chi_theo_cmtnd']) ? $value['dia_chi_theo_cmtnd'] : '',
                        'id_number' => !empty($value['so_cmtnd']) ? $value['so_cmtnd'] : '',
                        'id_date' => !empty($value['cap_ngay']) ? $value['cap_ngay']->toDateTimeString() : '',
                        'id_provide' => !empty($value['noi_cap']) ? $value['noi_cap'] : '',
                        'job' => !empty($value['nghe_nghiep']) ? $value['nghe_nghiep'] : '',
                        'personal_email' => !empty($value['email_ca_nhan']) ? $value['email_ca_nhan'] : '',
                        'role_id' => CVHT,
                        // 'full_name' => !empty($value['full_name']) ? $value['full_name'] : '',
                        // 'full_name' => !empty($value['full_name']) ? $value['full_name'] : '',
                    ];
                    $userId = Common::getObject(User::where('email', $field['email'])->first(), 'id');
                    // dd($userId);
                    if( $userId ){
                        CommonNormal::update($userId, $field, 'User');
                        $countUpdate++;
                    }else{
                        $userId = CommonNormal::create($field, 'User');
                        foreach ($centerLevels as $key2 => $centerLevel) {
                            $levelIds = Level::find($centerLevel->level_id)->where('subject_id', $subjectId)->lists('id');
                            if( $centerLevel->level_id && in_array($centerLevel->level_id, $levelIds) ){
                                CommonNormal::create([
                                    'user_id' => $userId,
                                    'center_level_id' => $centerLevel->id,
                                    'level_id' => $centerLevel->level_id,
                                ], 'UserCenterLevel');
                            }
                        }
                        $countInsert++;
                    }
                    // dd($field);
                }
            }
            echo 'Đã tạo mới: '.$countInsert.'<br>Đã cập nhật: '.$countUpdate;
            // dd($results);
        });
    }

	public function getImportVUser(){
		Excel::load('public/CTV_V.xlsx', function($reader) {
			$results = $reader->toArray();
			$centerId = Center::first()->id;
			$centerLevels = CenterLevel::where('center_id', $centerId)->get();
			$subjectId = Subject::where('code', 'V')->first()->id;
			$countInsert = $countUpdate = 0;

			// dd($results);
			foreach ($results as $key => $value) {
				if( !empty( $value['email_galileoeduvn'] ) ){
					$bangCap = !empty($value['bang_cap']) ? $value['bang_cap'].', ' : '';
					$khoa = !empty($value['nganh_hoc']) ? 'ngành '.$value['nganh_hoc'].', ' : '';
					$truong = !empty($value['truong']) ? 'trường '.$value['truong'].', ' : '';
					$xepLoai = !empty($value['xep_loai_tot_nghiep']) ? 'xếp loại tốt nghiệp '.$value['xep_loai_tot_nghiep'] : '';
					$field = [
						'full_name' => !empty($value['ho_ten_day_du']) ? $value['ho_ten_day_du'] : '',
						'email' => !empty($value['email_galileoeduvn']) ? $value['email_galileoeduvn'] : '',
						'start_date' => is_object($value['ngay_bat_dau_lam_viec']) ? $value['ngay_bat_dau_lam_viec']->toDateTimeString() : '',
						'birth_day' => is_object($value['ngay_sinh']) ? $value['ngay_sinh']->toDateTimeString() : '',
						'phone' => !empty($value['so_dt']) ? '0'.$value['so_dt'] : '',
						'current_address' => !empty($value['noi_o_hien_tai']) ? $value['noi_o_hien_tai'] : '',
						'address' => !empty($value['dia_chi_thuong_tru']) ? $value['dia_chi_thuong_tru'] : '',
						'id_number' => !empty($value['so_cmnd']) ? $value['so_cmnd'] : '',
						'id_date' => is_object($value['cap_ngay']) ? $value['cap_ngay']->toDateTimeString() : '',
						'id_provide' => !empty($value['noi_cap']) ? $value['noi_cap'] : '',
						'job' => $bangCap.$khoa.$truong.$xepLoai,
						'personal_email' => !empty($value['email']) ? $value['email'] : '',
						'role_id' => CVHT,
						'center_id' => $centerId,
						// 'full_name' => !empty($value['full_name']) ? $value['full_name'] : '',
						// 'full_name' => !empty($value['full_name']) ? $value['full_name'] : '',
					];
					$userId = Common::getObject(User::where('email', $field['email'])->first(), 'id');
					// dd($userId);
					if( $userId ){
						CommonNormal::update($userId, $field, 'User');
						$countUpdate++;
					}else{
						$userId = CommonNormal::create($field, 'User');
						foreach ($centerLevels as $key2 => $centerLevel) {
							$levelIds = Level::find($centerLevel->level_id)->where('subject_id', $subjectId)->lists('id');
							if( $centerLevel->level_id && in_array($centerLevel->level_id, $levelIds) ){
								CommonNormal::create([
									'user_id' => $userId,
									'center_level_id' => $centerLevel->id,
									'level_id' => $centerLevel->level_id,
								], 'UserCenterLevel');
							}
						}
						$countInsert++;
					}
					// dd($field);
				}
			}
			echo 'Đã tạo mới: '.$countInsert.'<br>Đã cập nhật: '.$countUpdate;
			// dd($results);
		});
	}

	public function import(){
		// ini_set('default_charset', 'utf-8');
		// header('Content-Type: text/html; charset=utf-8');
		$directory = 'F:/HocMai Drive/PDF_Galileo/T/4/D';
		$text = 'Galileo_Bu?i 01_��p �n_Ch��ng tr?nh h?c t?t_to�n_l?p 4_nh�m A1_ver 3.0.2017';
		dd(clean($text));
		$files = Common::listFolderFiles($directory);
		foreach ($files as $key => $file) {
			echo basename($file).'<br>';
		}
	}

	public function convert_vi_to_en($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		//$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
		return $str;
	}


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

    public function getVersionDoc()
    {
        $version = '1A';
        return $version;
    }
    public function renameFile($directory, $fileName, $text)
    {
        rename($directory.'/'.$fileName, $directory.'/'.$text);
    }
    
    public function controlerFile($fileName)
    {
            // dd($file);
        if (strstr($fileName, 'pdf')) {
            $fileName = str_replace('.pdf', "", $fileName);
        }
        // rename($file, $directory.'/'.'PT04_HTA1_01_1A.pdf');
        // $array = explode("_", $fileName);
        // $level = 0;

        // foreach ($array as $key => $value) {
        //     $check = utf8convert($value);
        //     $check = strtolower($check);
        //     if (strstr($check, 'nhom')) {
        //         $level = strtoupper(substr($check, -2));
        //         $level = 'HT'.$level;
        //         return $level;
        //     }
        //     // if (strstr($check, 'buoi')) {
        //     //     // dd(111);
        //     //     $test1 = explode(" ", $check);
        //     //     if (count($test1) > 0) {
        //     //         $a = array_search('buoi', $test1);
        //     //         $lessonCode = $test1[$a+1];
        //     //     }
        //     // }
        // }
        $level = $this->getLevel($fileName);
        $lessonCode = $this->getLessonCode($fileName);
        return $level.'_'.$lessonCode;
    }
    public function getLevel($fileName)
    {
        $array = explode("_", $fileName);
        $level = 0;
        foreach ($array as $key => $value) {
            $check = clean($value);
            $check = strtolower($check);
            if (strstr($check, 'nhom')) {
                $level = strtoupper(substr($check, -2));
                $level = 'HT'.$level;
                return $level;
            }
        }
        return $fileName;
    }
    public function getLessonCode($fileName)
    {
        // $fileName = 'Galileo_Buổi 1_Đáp án_Chương trình học tốt_Toán_Lớp 5_Nhóm B2_Ver 3.0.2017';
        $array = explode("_", $fileName);
        foreach ($array as $key => $value) {
            $check = clean($value);
            $check = strtolower($check);
            // dd($fileName);
            if (strstr($check, 'bu')) {
                // $lessonCode = substr($check, -2);
                // dd($check);
                // if (intval($lessonCode) > 0) {
                //     if (intval($lessonCode) < 10) {
                //         return '0'.intval($lessonCode);
                //     }
                //     return $lessonCode;
                // }
                // dd($fileName.'____'.$check);
                $test1 = explode("-", $check);
                if (count($test1) > 0) {
                    $a = array_search('bu', $test1);
                    try {
                        $lessonCode = $test1[$a+1];
                        if ($lessonCode > 0) {
                            if ($lessonCode < 10) {
                                if (strlen($lessonCode) == 2) {
                                    return $lessonCode;
                                } 
                                return '0'.$lessonCode;
                            }
                            return $lessonCode;
                        }
                    } catch (Exception $e) {
                        dd($fileName.'____'.$check);
                    }
                    
                }
                dd($fileName.'____'.$value.'-------'.$check);
            }
        }
        dd($fileName);
        return $fileName;
    }
    public function insert()
    {
        $this->commonInsert('T');
    }
    public function insertVan()
    {
        $this->commonInsert('V');
    }

    public function updatedb()
    {
        $docs = Document::groupBy('lesson_id')->get();
        foreach ($docs as $key => $value) {
            $list = Document::where('lesson_id', $value->lesson_id)->get();
            foreach ($list as $key => $doc) {
                $code = $doc->code;
                $code = explode("_", $code);
                $code[3] = '1A';
                $code = implode("_", $code);
                $order = 1;
                $docP = Document::where('lesson_id', $doc->lesson_id)
                    ->where('type_id', P)->first();
                $parentId = null;
                if ($docP) {
                    $parentId = $docP->id;
                    // Document::where('lesson_id', $doc->lesson_id)
                    // ->where('type_id', D)->update(['parent_id' => $docP->id]);
                }
                // $fileUrl = $doc->file_url;
                // $fileUrl = explode("/", $fileUrl);
                // $fileUrl[6] = $code.'.pdf';
                // $fileUrl = implode("/", $fileUrl);
                $doc->update([
                    'parent_id' => $parentId,
                    'code' => $code,
                    'order' => $order,
                ]);
            }
                
        }
        dd(123);
    }
    public function updatedbT()
    {
        $subjectCode = 'T';
        $subject = Subject::where('code', $subjectCode)->first();
        $subjectId = $subject->id;
        $docs = Document::groupBy('lesson_id')->where('subject_id', $subjectId)->get();
        foreach ($docs as $key => $value) {
            $list = Document::where('lesson_id', $value->lesson_id)->get();
            foreach ($list as $key => $doc) {
                $code = $doc->code;
                $code = explode("_", $code);
                $code[3] = '1A';
                $code = implode("_", $code);
                $order = 1;
                $docP = Document::where('lesson_id', $doc->lesson_id)
                    ->where('type_id', P)->first();
                $parentId = null;
                if ($docP) {
                    $parentId = $docP->id;
                    // Document::where('lesson_id', $doc->lesson_id)
                    // ->where('type_id', D)->update(['parent_id' => $docP->id]);
                }
                // $fileUrl = $doc->file_url;
                // $fileUrl = explode("/", $fileUrl);
                // $fileUrl[6] = $code.'.pdf';
                // $fileUrl = implode("/", $fileUrl);
                $doc->update([
                    'parent_id' => $parentId,
                    'code' => $code,
                    'order' => $order,
                ]);
            }
                
        }
        dd(123);
    }
    public function commonInsert($text)
    {
        $directory = public_path().DOCUMENT_UPLOAD_DIR.$text;
        $check = scandir($directory);
        foreach ($check as $key => $classCode) {
            if ($classCode > 0) {
                $checkClass = scandir($directory.'/'.$classCode);
                foreach ($checkClass as $k => $v) {
                    if (is_dir($directory.'/'.$classCode.'/'.$v)) {
                        $data = scandir($directory.'/'.$classCode.'/'.$v);
                        foreach ($data as $keyData => $fileName) {
                            if (!is_dir($directory.'/'.$classCode.'/'.$v.'/'.$fileName)) {
                                if (pathinfo($fileName, PATHINFO_EXTENSION) == 'docx') {
                                    unlink($directory.'/'.$classCode.'/'.$v.'/'.$fileName);
                                }

                                if (pathinfo($fileName, PATHINFO_EXTENSION) == 'pdf') {
                                    $fileNameOld =$fileName;
                                    if (strstr($fileName, 'pdf')) {
                                        $fileNameNew = str_replace('.pdf', "", $fileName);
                                    }
                                    if (strpos($fileNameNew, '(') || strpos($fileNameNew, 'v1')) {
                                        unlink($directory.'/'.$classCode.'/'.$v.'/'.$fileNameOld);
                                    }

                                    if (!strpos($fileNameNew, '(') && !strpos($fileNameNew, 'v1')) {
                                        $array = explode("_", $fileNameNew);
                                        $levelCode = $array[1];
                                        $lessonCode = $array[2];
                                        $classCode = substr($array[0], -2);
                                        if ($classCode < 10) {
                                            $classCode = substr($classCode, -1);
                                        }
                                        if ($lessonCode < 10) {
                                            $lessonCode = substr($lessonCode, -1);
                                        }
                                        $subjectCode = $text;
                                        $subject = Subject::where('code', $subjectCode)->first();
                                        $subjectId = $subject->id;
                                        $class = ClassModel::where('code', $classCode)->first();
                                        $classId = $class->id;
                                        $code = $fileNameNew;
                                        $level = Level::where('code', $levelCode)
                                            ->where('class_id', $classId)
                                            ->where('subject_id', $subjectId)
                                            ->first();
                                        if (!$level) {
                                            dd($fileName.'-----'.$levelCode. '--class: '.$classId.'---mon: '. $subjectId);
                                        }
                                        $levelId = $level->id;
                                        $lesson = Lesson::where('level_id', $levelId)
                                            ->where('class_id', $classId)
                                            ->where('subject_id', $subjectId)
                                            ->where('code', $lessonCode)
                                            ->first();
                                        if (!$lesson) {
                                            dd($levelId.'----'.$lessonCode.'----'.$fileName);
                                        }
                                        $lessonId = $lesson->id;
                                        $typeCode = substr($array[0], 0, 1);
                                        $type = DocumentType::where('code', $typeCode)->first();
                                        if (!$type) {
                                            dd('sai'.'--'.$typeCode.'--'.$fileName);
                                        }
                                        $fileUrl = DOCUMENT_UPLOAD_DIR.$text.'/'.$classCode.'/'.$levelCode.'/'.$fileName;

                                        $typeId = $type->id;
                                        $doc['class_id'] = $classId;
                                        $doc['subject_id'] = $subjectId;
                                        $doc['level_id'] = $levelId;
                                        $doc['file_url'] = $fileUrl;
                                        $doc['type_id'] = $typeId;
                                        $doc['code'] = $code;
                                        $doc['lesson_id'] = $lessonId;
                                        Document::create($doc);
                                    }
                                    
                                }
                            }
                        }
                    }
                }
            }
        }
        dd(123);
    }

}

