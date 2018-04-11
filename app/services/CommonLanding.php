<?php
use Carbon\Carbon;
class CommonLanding
{
    public static function getPeriod($period)
    {
        $array = [
            'period_1' => 'Đợt 1 ( Lớp 5: 08/04/2018, Lớp 9: 15/04 )',
            'period_2' => 'Đợt 2 ( Lớp 5: 22/04/2018, Lớp 9: 13/05 )',
            'period_3' => 'Đợt 3 (Lớp 5: 06/05/2018,Lớp 9: 27/05 )',
            'period_4' => 'Đợt 4 ( Lớp 5: 20/05/2018)'
        ];
        if (isset($array[$period])) {
            return $array[$period];
        }
        return null;
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
            1 => 'Toán',
            2 => 'Văn',
            3 => 'Cả 2 môn'
        ];
        return $array;
    }
}