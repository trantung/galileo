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
		]);
		AdminLanguage::create([
			'model_name'=> 'AdminNew',
			'model_id'=> 3,
			'relate_name' => 'AdminNew',
			'relate_id' => 4,
		]);

	}

}