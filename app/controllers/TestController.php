<?php

class TestController extends AdminController implements AdminInterface {

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
        // $directory = 'F:/HocMai Drive/PDF_Galileo/T/4/D';
        $directory = public_path().DOCUMENT_UPLOAD_DIR.'T';
        $check = scandir($directory);
        foreach ($check as $key => $classCode) {
            if ($classCode > 0) {
                $checkClass = scandir($directory.'/'.$classCode);
                foreach ($checkClass as $k => $typeName) {
                    if ($typeName == 'P' || $typeName =='D') {
                        $data = scandir($directory.'/'.$classCode.'/'.$typeName);
                        foreach ($data as $keyData => $fileName) {
                            if (!is_dir($directory.'/'.$classCode.'/'.$typeName.'/'.$fileName)) {
                                if (pathinfo($fileName, PATHINFO_EXTENSION) == 'pdf') {
                                    $text = $this->controlerFile($fileName);
                                    if ($classCode < 10) {
                                        $classCode1 = '0'.$classCode;
                                    } else {
                                        $classCode1 = $classCode;
                                    }
                                    $version = $this->getVersionDoc();
                                    $text = $typeName.'T'.$classCode1.'_'.$text.'_'.$version.'.pdf';
                                    $this->renameFile($directory.'/'.$classCode.'/'.$typeName, $fileName, $text);
                                }
                            }
                        }
                    }
                    
                }
            }
        }
        dd(123);
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
