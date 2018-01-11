<?php

class SubjectClassTableSeeder extends Seeder {

    public function run()
    {
        $classes = ClassModel::lists('id');
        $subjects = Subject::lists('id');
        foreach ($classes as $class) {
            foreach ($subjects as $subject) {
                SubjectClass::create([
                    'class_id' => $class,
                    'subject_id' => $subject,
                ]);
            }
        }
        
    }

}