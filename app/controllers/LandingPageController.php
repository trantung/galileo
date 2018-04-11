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
        return View::make('landing_page.index')->with(compact('utmSource', 'utmMedium', 'utmCampaign','utmTerm'));
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
            return Redirect::back()->withErrors(['số điện thoại phải có']);
        }
        if (!checkValidatePhoneNumber($input['phone'])) {
            return Redirect::back()->withErrors(['số điện thoại không đúng']);
        }
        // dd(111);
        LandingPage::create($input)->id;
        //TO DO send mail
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
        Mail::send('emails.landing_page', $data, function($message) use ($input, $data){
            $message->to($input['email'])
                ->subject(LANDING_PAGE_EMAIL_SUBJECT);
        });
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
        
    }
    public function admin()
    {
        $input = Input::all();
        $data = LandingPage::orderBy('created_at', 'DESC');
        // dd($input);
        if( !empty($input['fullname']) ){
            $data = $data->where('fullname', $input['fullname']);
        }
        if( !empty($input['phone']) ){
            $data = $data->where('phone', 'LIKE', '%'.$input['phone'].'%');
        }
        if( !empty($input['email']) ){
            $data = $data->where('email', 'LIKE', '%'.$input['email'].'%');
        }
        if( !empty($input['period']) ){
            if ($input['period'] == 'period_1') {
                $data = $data->where('period_1', 'on');
            }
            if ($input['period'] == 'period_2') {
                $data = $data->where('period_2', 'on');
            }
            if ($input['period'] == 'period_3') {
                $data = $data->where('period_3', 'on');
            }
            if ($input['period'] == 'period_4') {
                $data = $data->where('period_4', 'on');
            }
        }

        if( !empty($input['address']) ){
            $data = $data->where('address', $input['address']);
        }
        if( !empty($input['class']) ){
            $data = $data->where('class', $input['class']);
        }
        if( !empty($input['check_subject']) ){
            $data = $data->where('check_subject', $input['check_subject']);
        }
        if( !empty($input['status']) ){
            $data = $data->where('status', $input['status']);
        }
        if( !empty($input['comment']) ){
            $data = $data->where('comment', 'LIKE', '%'.$input['comment'].'%');
        }
        $count = $data->count();
        $data = $data->paginate(PAGINATE);
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


}
