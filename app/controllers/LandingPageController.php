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
        // dd($input);
        if( !empty($input['period']) ){
            $data = LandingPage::join('landing_page_relation_periods', 'landing_pages.id', '=', 'landing_page_relation_periods.landing_page_id');
            $data = $data->where('landing_page_relation_periods.period_id', $input['period']);
        } else {
            $data = LandingPage::orderBy('created_at', 'DESC');
        }
        if( !empty($input['parent_name']) ){
            $data = $data->where('parent_name', $input['parent_name']);
        }

        if( !empty($input['fullname']) ){
            $data = $data->where('fullname', $input['fullname']);
        }
        if( !empty($input['phone']) ){
            $data = $data->where('phone', 'LIKE', '%'.$input['phone'].'%');
        }
        if( !empty($input['email']) ){

            $data = $data->where('email', 'LIKE', '%'.$input['email'].'%');
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
        if( !empty($input['comment']) ){
            $data = $data->where('comment', 'LIKE', '%'.$input['comment'].'%');
        }
        if( !empty($input['utm_source']) ){
            if ($input['utm_source'] == '-1') {
                $data = $data->where('utm_source', '');
            } else {
                $data = $data->where('utm_source', 'LIKE', '%'.$input['utm_source'].'%');
            }
        }

        if( !empty($input['utm_medium']) ){
            if ($input['utm_medium'] == '-1') {
                $data = $data->where('utm_medium', '');
            } else {
                $data = $data->where('utm_medium', 'LIKE', '%'.$input['utm_medium'].'%');
            }
        }

        if( !empty($input['utm_campaign']) ){
            if ($input['utm_campaign'] == '-1') {
                $data = $data->where('utm_campaign', '');
            } else {
                $data = $data->where('utm_campaign', 'LIKE', '%'.$input['utm_campaign'].'%');
            }
        }
        $count = $data->count();
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
}
