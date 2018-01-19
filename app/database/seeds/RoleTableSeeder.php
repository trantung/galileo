<?php

class RoleTableSeeder extends Seeder {

    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'code'=> 'ADMIN',
            'status'=> 1
        ]);
        Role::create([
            'name' => 'Biên tập viên',
            'code'=> 'BTV',
            'status'=> 1
        ]);

    }

}