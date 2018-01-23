<?php

class LessonTableSeeder extends Seeder {

    public function run()
    {
        $level = Level::all();
        foreach ($level as $key => $value) {
            $numberLesson = $value->number_lesson;
            for ($i=0; $i < $numberLesson; $i++) { 
                $code = $i + 1;
                $input = [
                    'level_id' => $value->id,
                    'subject_id' => $value->subject_id,
                    'class_id' => $value->class_id,
                    'name' => 'Buổi '. $code,
                    'code' => $code,
                    'status' => 1,
                ];
                Lesson::create($input);
            }
        }
    }

}