<?php

class Admin2TableSeeder extends Seeder {

    public function run()
    {
        Admin::create([
            'role_id' => 1,
            'email'=>'tiennq@hocmai.vn',
            'password'=>Hash::make('123456'),
            'username'=> 'tiennq'
        ]);
        Admin::create([
            'role_id' => 1,
            'email'=>'ngadt2@hocmai.vn',
            'password'=>Hash::make('123456'),
            'username'=> 'ngadt2'
        ]);
    }
}