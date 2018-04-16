<?php

class LandingPageController extends \BaseController {

    public function __construct() {
            $this->beforeFilter('orther', array('except'=>array('login','doLogin')));
        }
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
            ->get();
            $count = count($count);
        // dd(count($count));
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
        $objPHPExcel = new PHPExcel();
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
        Excel::create($fileName, function($excel) use ($dataArray) {
            $excel->sheet('mySheet', function($sheet) use ($dataArray){
                $sheet->getStyle('1')->applyFromArray(array(
                    'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '3c8dbc'),
                    ),
                    'font-weight' => 'bold',
                    'bold' => true,
                    'color' => array('rgb' => 'FFFFFF'),
                ));
                $sheet->fromArray($dataArray);
            });
        })->download('xls');
        return Redirect::action('LandingPageController@admin');
    }

    public function login()
    {
        $checkLogin = Auth::check();
        if($checkLogin) {
            return Redirect::action('LandingPageController@index');
        } else {
            return View::make('landing_page.login');
        }
    }
    public function doLogin()
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );
        $input = Input::except('_token');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::action('AdminController@login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            if($input['username'] == 'user' && $input['password'] == '123456') {
                Session::put(SESSION_LANDING_LOGIN, $input);
                return Redirect::action('LandingPageController@index');
            } else {
                Session::forget(SESSION_LANDING_LOGIN);
                return Redirect::action('LandingPageController@login');
            }
        }
    }
}
