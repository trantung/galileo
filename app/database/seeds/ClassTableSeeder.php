<?php

class ClassTableSeeder extends Seeder {

    public function run()
    {
        $array = [4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($array as $value) {
            ClassModel::create([
                'code' => $value,
                'name'=>'Lớp '. $value,
            ]);
        }
    }

}