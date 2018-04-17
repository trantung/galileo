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

        if ($input['class'] == '') {
            return Redirect::back()->with('msg_class', 'Phải chọn lớp');
        }
        if (!checkValidatePhoneNumber($input['phone'])) {
            return Redirect::back()->with('msg_phone_valid', 'Số điện thoại sai');
        }
        $periods = CommonLanding::getPeriodLanding($input);
        if (count($periods) == 0) {
            return Redirect::back()->with('msg_address', 'Phải chọn đợt thi');
        }
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
        //send mail to center
        $landingPage = LandingPage::find($id);
        $messageContentCenter = 'nội dung thông báo: '.$input['fullname'].'_'.'số điện thoại: '. $input['phone']. '_'.'lớp: '.$input['class'].'_'. 'đợt đăng ký: '. CommonLanding::getPeriodStudent($landingPage) . 'Môn thi: '. CommonLanding::getSubjectName($landingPage->check_subject). 'vừa hoàn thành đăng kí lúc'. $landingPage->created_at ;
        $dataCenter = [
            'title' => 'Nội dung thông báo đăng ký ldp của học sinh',
            'content' => '',
            'messageContent' => $messageContentCenter,
        ];
        if (!empty($input['address'])) {
            if ($input['address'] == 1) {
                $emailCenter = 'sale@galileo.edu.vn';
                Mail::send('emails.landing_page', $dataCenter, function($message) use ($input, $dataCenter, $emailCenter){
                    $message->to($emailCenter)
                        ->subject(LANDING_PAGE_EMAIL_SUBJECT_CENTER);
                });
            }
        }
        if (!empty($input['address'])) {
            if ($input['address'] == 2) {
                $emailCenter = 'ngocvt@galileo.edu.vn';
                Mail::send('emails.landing_page', $dataCenter, function($message) use ($input, $dataCenter, $emailCenter){
                    $message->to($emailCenter)
                        ->subject(LANDING_PAGE_EMAIL_SUBJECT_CENTER);
                });
            }
        }
        if (!empty($input['address'])) {
            if ($input['address'] == 3) {
                $emailCenter = 'linhltk@galileo.edu.vn';
                Mail::send('emails.landing_page', $dataCenter, function($message) use ($input, $dataCenter, $emailCenter){
                    $message->to($emailCenter)
                        ->subject(LANDING_PAGE_EMAIL_SUBJECT_CENTER);
                });
            }
        }
        if (!empty($input['address'])) {
            if ($input['address'] == 4) {
                $emailCenter = 'movt@galileo.edu.vn';
                Mail::send('emails.landing_page', $dataCenter, function($message) use ($input, $dataCenter, $emailCenter){
                    $message->to($emailCenter)
                        ->subject(LANDING_PAGE_EMAIL_SUBJECT_CENTER);
                });
            }
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
        // dd($input);
        $data = CommonLanding::commonThongkeLanding($input);
        $count = $data->groupBy('email')
            ->groupBy('phone')
            ->groupBy('fullname')
            ->groupBy('parent_name')
            ->groupBy('class')
            ->get();
        $count = count($count);
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
        dd($input);
        $objPHPExcel = new PHPExcel();
        $data = CommonLanding::commonThongkeLanding($input);
        $data = $data->groupBy('email')
            ->groupBy('phone')
            ->groupBy('fullname')
            ->groupBy('parent_name')
            ->groupBy('class')
            ->get();
        $fileName = 'filename';
        $activeSheet = $objPHPExcel->getActiveSheet();
        $activeSheet->setCellValue('A1', 'STT')
            ->setCellValue('B1', 'Họ và tên bố/mẹ')
            ->setCellValue('C1', 'Họ và tên HS')
            ->setCellValue('D1', 'Số điện thoại')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'Lớp học')
            ->setCellValue('G1', 'Đợt thi')
            ->setCellValue('H1', 'Địa điểm thi')
            ->setCellValue('I1', 'Môn kiểm tra')
            ->setCellValue('J1', 'Nguyện vọng');
        $r = 2;
        $i = 1;
        foreach ($data as $value) {
            $activeSheet->setCellValue('A'.$r, $i++)
                ->setCellValue('B'.$r, $value->parent_name)
                ->setCellValue('C'.$r, $value->fullname)
                ->setCellValue('D'.$r, $value->phone)
                ->setCellValue('E'.$r, $value->email)
                ->setCellValue('F'.$r, $value->class)
                ->setCellValue('G'.$r, CommonLanding::getPeriodStudent($value))
                ->setCellValue('H'.$r, CommonLanding::getAddressName($value->address))
                ->setCellValue('I'.$r, CommonLanding::getSubjectName($value->check_subject))
                ->setCellValue('J'.$r, $value->comment);
            $r++;
        }
        $activeSheet->setTitle('Danh sách');
        $objPHPExcel->setActiveSheetIndex(0);
        ob_clean();
        $filename = "name".time().".xlsx";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        dd(111);
        return Redirect::action('LandingPageController@admin');
    }
}
