<?php

class LevelTableSeeder extends Seeder {

    public function run()
    {
        $classCode = '4';
        $subjectLevels = [
            'T' => 'Học tốt A1, Học tốt B1, Học tốt C1, Học tốt D1, Học tốt E1, Nền tảng A1, Nền tảng B1, Nền tảng C1, Nền tảng D1, Nền tảng E1, Mục tiêu A1, Mục tiêu B1, Mục tiêu C1, Mục tiêu D1,Mục tiêu E1',
            'V' => 'Học tốt A1, Học tốt B1, Học tốt C1, Học tốt D1, Học tốt E1, Nền tảng A1, Nền tảng B1, Nền tảng C1, Nền tảng D1, Nền tảng E1, Mục tiêu A1, Mục tiêu B1, Mục tiêu C1, Mục tiêu D1,Mục tiêu E2'
        ];
        Common::getExcelLevel($subjectLevels, $classCode);
        $arrayClass = [5,6,7,8,9,10,11,12];
        $subjectLevelsOther = [
            'T' => 'Học tốt A1, Học tốt A2, Học tốt B1, Học tốt B2, Học tốt C1, Học tốt C2, Học tốt D1, Học tốt D2, Học tốt E1, Học tốt E2, Nền tảng A1, Nền tảng A2, Nền tảng B1, Nền tảng B2, Nền tảng C1, Nền tảng C2, Nền tảng D1, Nền tảng D2, Nền tảng E1, Nền tảng E2, Mục tiêu A1, Mục tiêu A2, Mục tiêu B1, Mục tiêu B2, Mục tiêu C1, Mục tiêu C2, Mục tiêu D1, Mục tiêu D2, Mục tiêu E1, Mục tiêu E2',
            'V' => 'Học tốt A1, Học tốt A2, Học tốt B1, Học tốt B2, Học tốt C1, Học tốt C2, Học tốt D1, Học tốt D2, Học tốt E1, Học tốt E2, Nền tảng A1, Nền tảng A2, Nền tảng B1, Nền tảng B2, Nền tảng C1, Nền tảng C2, Nền tảng D1, Nền tảng D2, Nền tảng E1, Nền tảng E2, Mục tiêu A1, Mục tiêu A2, Mục tiêu B1, Mục tiêu B2, Mục tiêu C1, Mục tiêu C2, Mục tiêu D1, Mục tiêu D2, Mục tiêu E1, Mục tiêu E2',
        ];
        foreach ($arrayClass as $key => $value) {
            Common::getExcelLevel($subjectLevelsOther, $value);
        }
    }

}