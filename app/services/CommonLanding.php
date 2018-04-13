<?php
use Carbon\Carbon;
class CommonLanding
{
    public static function getPeriod($periodId)
    {
        $array = [
            1 => 'Đợt 1 ( Lớp 5: 08/04/2018)',
            2 => 'Đợt 2 (Lớp 5: 22/04/2018 )',
            3 => 'Đợt 3 (Lớp 5: 06/05/2018)',
            4 => 'Đợt 4 (Lớp 5: 20/05/2018)',
            5 => 'Đợt 1 (Lớp 9: 15/04 )',
            6 => 'Đợt 2 (Lớp 9: 13/05 )',
            7 => 'Đợt 3 (Lớp 9: 27/05 )',
        ];
        if (isset($array[$periodId])) {
            return $array[$periodId];
        }
        return null;
    }
    public static function getPeriodLanding($input)
    {
        $period = [];
        if (!empty($input['period_1'])) {
            $period[] = 1; 
        }
        if (!empty($input['period_2'])) {
            $period[] = 2; 
        }
        if (!empty($input['period_3'])) {
            $period[] = 3; 
        }
        if (!empty($input['period_4'])) {
            $period[] = 4; 
        }
        if (!empty($input['period_5'])) {
            $period[] = 5; 
        }
        if (!empty($input['period_6'])) {
            $period[] = 6; 
        }
        if (!empty($input['period_7'])) {
            $period[] = 7; 
        }
        return $period;
    }
    public static function getStudentDefault()
    {
        $array = [
            '1523267880' => 'Trần Thanh Tùng',
            '1523267884' => 'Nguyễn Tiến Dũng',
            '1523267888' => 'Nguyễn Văn A',
            '1523267892' => 'Nguyễn Văn B',
            '1523267896' => 'Nguyễn Văn B1',
            '1523267900' => 'Nguyễn Văn B2',
            '1523267904' => 'Nguyễn Văn B3',
            '1523267908' => 'Nguyễn Văn B3',
            '1523267912' => 'Nguyễn Văn B4',
            '1523267916' => 'Nguyễn Văn B5',
            '1523267920' => 'Nguyễn Văn B6',
            '1523268129' => 'Nguyễn Văn B7',
            '1523268200' => 'Nguyễn Văn B8',
            '1523268204' => 'Nguyễn Văn B9',
        ];
        return $array;
    }   
    public static function getStudentCurrent($time = null)
    {
        // if (!$time) {
        //     $time = time();
        // }
        // // dd($time);
        // $array = self::getStudentDefault();
        // // return $array[$time];

        // // dd($array['1523267577']);
        // if (isset($array[$time])) {
        //     return $array[$time];
        // }
        // // dd($time);

        // foreach ($array as $key => $value) {
        //     if ($time < $key) {
        //        return $array[$key];
        //     }
        // }
        $list = LandingPage::orderBy('id', 'desc')->first();
        if ($list) {
            return $list->fullname;
        }
        return null;
        return end($array);
    }
    public static function getSubject()
    {
        $array = [
            '' => 'Tất cả',
            1 => 'Toán',
            2 => 'Văn',
            3 => 'Cả 2 môn'
        ];
        return $array;
    }
    public static function getClass()
    {
        $data = [
            '' => 'Chọn tất cả',
            5 => 'Lớp 5',
            9 => 'Lớp 9'
        ];
        return $data;
    }
    public static function getPeriodStudent($data)
    {
        $text = '';
        if ($data->period_1) {
            $text = $text. self::getPeriod('period_1').', ';
        }
        if ($data->period_2) {
            $text = $text. self::getPeriod('period_2').', ';
        }
        if ($data->period_3) {
            $text = $text. self::getPeriod('period_3').', ';
        }
        if ($data->period_4) {
            $text = $text. self::getPeriod('period_4').', ';
        }
        return $text;
    }
    public static function getPeriodName()
    {
        $array = LandingPagePeriod::lists('name', 'id');
        $array = [ '' => 'Tất cả'] + $array;
        return $array;
    }
    public static function getAddress()
    {
        $array = [

            '' => 'Tất cả',
            1 => 'Cơ sở 1',
            2 => 'Cơ sở 2',
            3 => 'Cơ sở 3',
            4 => 'Cơ sở 4'
        ];
        return $array;
    }
    public static function getAddressName($address)
    {
        $data = self::getAddress();
        if (!empty($data[$address])) {
            return $data[$address];
        }
        return null;
    }

    public static function getSubjectName($subject)
    {
        $array = self::getSubject();
        if (!empty($array[$subject])) {
            return $array[$subject];
        }
        return null;
    }
    public static function getStatus()
    {
        $array = [
            '' => 'Tất cả',
            1 => 'Có',
            2 => 'Không',
        ];
        return $array;
    }
    public static function getUtmSource()
    {
        $source = LandingPage::distinct('utm_source')->lists('utm_source', 'utm_source');
        foreach ($source as $key => $value) {
            if (empty($value)) {
                unset($source[$key]);
                $source['-1'] = 'Không có nguồn';
            }
        }
        $source = [''=>'Tất cả'] + $source;
        return $source;
    }
    public static function getUtmMedium()
    {
        $medium = LandingPage::distinct('utm_medium')->lists('utm_medium', 'utm_medium');
        foreach ($medium as $key => $value) {
            if (empty($value)) {
                unset($medium[$key]);
                $medium['-1'] = 'Không có phương tiện';
            }
        }
        $medium = [''=>'Tất cả'] + $medium;
        return $medium;
    }
    public static function getUtmCampaign()
    {   
        $campaign = LandingPage::distinct('utm_campaign')->lists('utm_campaign', 'utm_campaign');
        foreach ($campaign as $key => $value) {
            if (empty($value)) {
                unset($campaign[$key]);
                $campaign['-1'] = 'Không có chiến dịch';
            }
        }
        $campaign = [''=>'Tất cả'] + $campaign;
        return $campaign;
    }

    public static function getUtm()
    {
        $utm = LandingPage::all();
        dd($utm->utm_source);
    }

}
