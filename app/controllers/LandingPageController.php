<?php

class LandingPageController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $utmSource = $utmCampaign = $utmMedium = $utmTerm = null;
        if (Input::get('utm_source')) {
            $utmSource = Input::get('utm_source');
        }
        if (Input::get('utm_medium')) {
            $utmMedium = Input::get('utm_medium');
        }
        if (Input::get('utm_campaign')) {
            $utmCampaign = Input::get('utm_campaign');
        }
        if (Input::get('utm_term')) {
            $utmTerm = Input::get('utm_term');
        }
        if (getDevice() == COMPUTER) {
            return View::make('landing_page.index')->with(compact('utmSource', 'utmMedium', 'utmCampaign','utmTerm'));
        }
        return View::make('landing_page.index_mobile')->with(compact('utmSource', 'utmMedium', 'utmCampaign','utmTerm'));
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
        if (empty($input['phone'])) {
            return Redirect::back()->with('msg_phone', 'Số điện thoại phải có');
        }
        if (empty($input['fullname'])) {
            return Redirect::back()->with('msg_fullname', 'Tên học sinh phải có');
        }

        if ($input['class'] == 1) {
            return Redirect::back()->with('msg_class', 'Phải chọn lớp');
        }
        if (!checkValidatePhoneNumber($input['phone'])) {
            return Redirect::back()->with('msg_phone_valid', 'Số điện thoại sai');
        }
        $periods = CommonLanding::getPeriodLanding($input);
        $id = LandingPage::create($input)->id;
        foreach ($periods as $key => $value) {
            LandingPagePeriodRelation::create(['period_id' => $value, 'landing_page_id' => $id]);
        }
        $parentName = '';
        if (!empty($input['parent_name'])) {
            $parentName = $input['parent_name'];
        }
        $title = 'Kính gửi '.$parentName.'!';
        $content = '';
        $messageContent = 'Chúc mừng Quý phụ huynh/Bạn đã đăng ký tham gia thành công chương trình <b>
        Kiểm tra đánh giá năng lực vào lớp 6/thi thử vào lớp 10 </b>của Hệ thống giáo dục HOCMAI. HOCMAI sẽ liên hệ để xác nhận các thông tin của Bạn trong vòng 1 ngày sau khi đăng ký.
        <br/>
        Trân trọng!';
        $data = [
            'title' => $title,
            'content' => $content,
            'messageContent' => $messageContent,
        ];
        if (!empty($input['email'])) {
            Mail::send('emails.landing_page', $data, function($message) use ($input, $data){
                $message->to($input['email'])
                    ->subject(LANDING_PAGE_EMAIL_SUBJECT);
            });
        }
        $message = 'success';
        return Redirect::action('LandingPageController@index')->withMessage($message);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        //    
    }

    public function admin()
    {
        $input = Input::all();
        $data = CommonLanding::commonThongkeLanding($input);
        $count = $data->groupBy('email')
            ->groupBy('phone')
            ->groupBy('fullname')
            ->groupBy('parent_name')
            ->groupBy('class')
            ->count();
        $data = $data->groupBy('email')
            ->groupBy('phone')
            ->groupBy('fullname')
            ->groupBy('parent_name')
            ->groupBy('class')
            ->paginate(PAGINATE);
        return View::make('landing_page.show')->with(compact('data', 'count'));
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
        $data = LandingPage::find($id);
        if ($data) {
            $data->delete();
        }
        return Redirect::action('LandingPageController@admin');
    }
    public function exportExcel()
    {
        $input = Input::all();
        $data = CommonLanding::commonThongkeLanding($input);
        $data = $data->groupBy('email')
            ->groupBy('phone')
            ->groupBy('fullname')
            ->groupBy('parent_name')
            ->groupBy('class')
            ->get();
        $dataHeader = [
            'Ba me', 
            'Hoc sinh', 
            'So dien thoai', 
            'Email', 
            'Lop hoc',
            'Dot thi', 
            'Dia diem', 
            'Mon kiem tra', 
            'Nguyen vong'
        ];
        $fileName = 'filename';
        $dataArray = [];
        foreach ($data as $key => $value) {
            $dataArray[] = [
                'STT' => $key+1,
                'Họ và tên bố/mẹ' => $value->parent_name,
                'Họ và tên HS' => $value->fullname,
                'Số điện thoại' => $value->phone,
                'Email' => $value->email,
                'Lớp học' => $value->class,

                'SĐT' => $value->phone,
                'Đợt thi' => CommonLanding::getPeriodStudent($value),
                'Địa điểm thi' => CommonLanding::getAddressName($value->address),
                'Môn kiểm tra' => CommonLanding::getSubjectName($value->check_subject),
                'Nguyện vọng' => $value->comment,
            ];
        }

        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u',
                        ' ', $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }
        
        // file name for download
        $fileName = "codexworld_export_data" . date('Ymd') . ".xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/json; charset=utf8_decode");
        header('Content-type: text/html; charset=utf-8');
        header("Content-Transfer-Encoding: UTF-8");
        header('Content-Encoding: UTF-8');
        $flag = false;
        foreach($dataArray as $row) {
            if(!$flag) {
                // display column names as first row
                echo implode("\t", array_keys($row)) . "\n";
                $flag = true;
            }
            // filter data
            // array_walk($row, 'filterData');
            echo implode("\t", array_values($row)) . "\n";

        }
         exit;
        // Excel::create($fileName, function($excel) use ($dataArray) {
        //     $excel->sheet('mySheet', function($sheet) use ($dataArray){
        //         $sheet->getStyle('1')->applyFromArray(array(
        //             'fill' => array(
        //                 'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        //                 'color' => array('rgb' => '3c8dbc'),
        //             ),
        //             'font-weight' => 'bold',
        //             'bold' => true,
        //             'color' => array('rgb' => 'FFFFFF'),
        //         ));
        //         $sheet->fromArray($dataArray);
        //     });
        // })->download('xls');

        return Redirect::action('LandingPageController@admin');
    }

}
