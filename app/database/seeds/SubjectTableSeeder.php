<?php

class SubjectTableSeeder extends Seeder {

    public function run()
    {
        $array = [
            'T' => 'Toán', 
            'V' => 'Ngữ văn/Tiếng việt',
        ];
        foreach ($array as $key => $value) {
            Subject::create([
                'code' => $key,
                'name' => $value,
            ]);
        }
    }

}