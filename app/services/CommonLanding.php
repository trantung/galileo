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
}