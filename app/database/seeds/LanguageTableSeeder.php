<?php

class LanguageTableSeeder extends Seeder {

	public function run()
	{
		AdminLanguage::create([
			'model_name'=> 'TypeNew',
			'model_id'=> 1,
			'relate_name' => 'TypeNew',
			'relate_id' => 2,
			'position' => 1,
			'status' => 1,
		]);
		AdminLanguage::create([
			'model_name'=> 'TypeNew',
			'model_id'=> 3,
			'relate_name' => 'TypeNew',
			'relate_id' => 4,
			'position' => 2,
			'status' => 1,
		]);
		AdminLanguage::create([
			'model_name'=> 'AdminNew',
			'model_id'=> 1,
			'relate_name' => 'AdminNew',
			'relate_id' => 2,
			'status' => 2,
			'position' => 1,
		]);
		AdminLanguage::create([
			'model_name'=> 'AdminNew',
			'model_id'=> 3,
			'relate_name' => 'AdminNew',
			'relate_id' => 4,
			'status' => 2,
			'position' => 2,
		]);
		AdminLanguage::create([
			'model_name'=> 'BottomText',
			'model_id'=> 1,
			'relate_name' => 'BottomText',
			'relate_id' => 2,
			'status' => 2,
		]);
		AdminLanguage::create([
			'model_name'=> 'Contact',
			'model_id'=> 1,
			'relate_name' => 'Contact',
			'relate_id' => 2,
			'status' => 2,
		]);
		AdminLanguage::create([
			'model_name'=> 'Introduce',
			'model_id'=> 1,
			'relate_name' => 'Introduce',
			'relate_id' => 2,
			'status' => 2,
		]);
		AdminLanguage::create([
			'model_name'=> 'Introduce',
			'model_id'=> 3,
			'relate_name' => 'Introduce',
			'relate_id' => 4,
			'status' => 2,
		]);
		AdminLanguage::create([
			'model_name'=> 'Introduce',
			'model_id'=> 5,
			'relate_name' => 'Introduce',
			'relate_id' => 6,
			'status' => 2,
		]);

	}

}