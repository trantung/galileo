<?php

class DocumentTypeTableSeeder extends Seeder {

    public function run()
    {
        DocumentType::create([
            'name'=>'Câu hỏi',
            'code'=>'P',
            'status'=>1,
        ]);
        DocumentType::create([
            'name'=>'Đáp án',
            'code'=>'D',
            'status'=>1,
        ]);

    }

}