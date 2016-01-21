<?php

class DesContentTableSeeder extends Seeder {

	public function run()
	{
		DesContent::create([
				'title' => 'gioi thieu trang chu',
				'description'=>'description gioi thieu trang chu',
				'slug'=>'gioi-thieu-trang-chu',
			]);
		DesContent::create([
				'title' => 'home about-us',
				'description'=>'home description en',
				'slug'=>'about-us-home',
			]);
	}

}