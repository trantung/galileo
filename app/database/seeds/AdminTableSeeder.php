<?php

class AdminTableSeeder extends Seeder {

    public function run()
    {
        Admin::create([
            'role_id' => 1,
            'email'=>'trantunghn196@gmail.com',
            'password'=>Hash::make('123456'),
            'username'=> 'tung1984'
        ]);
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