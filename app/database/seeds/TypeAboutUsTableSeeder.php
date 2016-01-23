<?php

class TypeAboutUsTableSeeder extends Seeder {

	public function run()
	{
		TypeAboutUs::create([
			'name'=> 'Giới thiệu',
			'name_shadow'=> 'về chúng tôi'
		]);
		TypeAboutUs::create([
			'name'=> 'About Us',
			'name_shadow'=> 'who we are'
		]);
		TypeAboutUs::create([
			'name'=> 'Lịch sử',
			'name_shadow'=> 'Hành trình'
		]);
		TypeAboutUs::create([
			'name'=> 'Our history',
			'name_shadow'=> 'Our way'
		]);
		TypeAboutUs::create([
			'name'=> 'Định hướng',
			'name_shadow'=> 'Triển vọng'
		]);
		TypeAboutUs::create([
			'name'=> 'ORIENTATIONS',
			'name_shadow'=> 'PROSPECTS'
		]);

		AdminLanguage::create([
			'model_name'=> 'TypeAboutUs',
			'model_id'=> 1,
			'relate_name' => 'TypeAboutUs',
			'relate_id' => 2,
			'position' => 1,
		]);
		AdminLanguage::create([
			'model_name'=> 'TypeAboutUs',
			'model_id'=> 3,
			'relate_name' => 'TypeAboutUs',
			'relate_id' => 4,
			'position' => 2,
		]);
		AdminLanguage::create([
			'model_name'=> 'TypeAboutUs',
			'model_id'=> 5,
			'relate_name' => 'TypeAboutUs',
			'relate_id' => 6,
			'position' => 3,
		]);
		
	}

}