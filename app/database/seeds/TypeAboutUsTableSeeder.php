<?php

class TypeAboutUsTableSeeder extends Seeder {

	public function run()
	{
		TypeAboutUs::create([
			'name'=> 'Giới thiệu',
			'name_shadow'=> 'về chúng tôi',
			'sort' => 1
		]);
		TypeAboutUs::create([
			'name'=> 'About Us',
			'name_shadow'=> 'who we are',
			'sort' => 1
		]);
		TypeAboutUs::create([
			'name'=> 'Lịch sử',
			'name_shadow'=> 'Hành trình',
			'sort' => 2
		]);
		TypeAboutUs::create([
			'name'=> 'Our history',
			'name_shadow'=> 'Our way',
			'sort' => 2
		]);
		TypeAboutUs::create([
			'name'=> 'Định hướng',
			'name_shadow'=> 'Triển vọng',
			'sort' => 3
		]);
		TypeAboutUs::create([
			'name'=> 'ORIENTATIONS',
			'name_shadow'=> 'PROSPECTS',
			'sort' => 3
		]);

		AdminLanguage::create([
			'model_name'=> 'TypeAboutUs',
			'model_id'=> 1,
			'relate_name' => 'TypeAboutUs',
			'relate_id' => 2,
			'position' => 1,
			'status' => 1,
		]);
		AdminLanguage::create([
			'model_name'=> 'TypeAboutUs',
			'model_id'=> 3,
			'relate_name' => 'TypeAboutUs',
			'relate_id' => 4,
			'position' => 2,
			'status' => 2,
		]);
		AdminLanguage::create([
			'model_name'=> 'TypeAboutUs',
			'model_id'=> 5,
			'relate_name' => 'TypeAboutUs',
			'relate_id' => 6,
			'position' => 3,
			'status' => 1,
		]);
		
	}

}