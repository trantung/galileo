<?php

class LandingPagePeriodTable extends Seeder {

    public function run()
    {
        LandingPagePeriod::create([
            'name' => 'Đợt 1 ( Lớp 5: 08/04/2018)',
        ]);
        LandingPagePeriod::create([
            'name' => 'Đợt 2 (Lớp 5: 22/04/2018 )',
        ]);
        LandingPagePeriod::create([
            'name' => 'Đợt 3 (Lớp 5: 06/05/2018)',
        ]);
        LandingPagePeriod::create([
            'name' => 'Đợt 4 (Lớp 5: 20/05/2018)',
        ]);
        LandingPagePeriod::create([
            'name' => 'Đợt 1 (Lớp 9: 15/04 )',
        ]);
        LandingPagePeriod::create([
            'name' => 'Đợt 2 (Lớp 9: 13/05 )',
        ]);
        LandingPagePeriod::create([
            'name' => 'Đợt 3 (Lớp 9: 27/05 )',
        ]);
    }

}