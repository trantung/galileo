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
        // dd($input);
        LandingPage::create($input)->id;
        //TO DO send mail
        $data = [
            // 'string' => $string,
            // 'lessonDetail' => $lessonDetail,
            // 'lessonDuration' => $input['lesson_duration'],
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
            $data = $data->where('phone', $input['phone']);
        }
        if( !empty($input['email']) ){
            $data = $data->where('email', $input['email']);
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
        $data = $data->paginate(PAGINATE);
        return View::make('landing_page.show')->with(compact('data'));
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
