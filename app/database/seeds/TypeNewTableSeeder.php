<?php

class TypeNewTableSeeder extends Seeder {

	public function run()
	{
		TypeNew::create([
			'name'=> 'Giói thiệu',
			'slug'=> 'gioi-thieu'
		]);
		TypeNew::create([
			'name'=> 'About-us',
			'slug'=> 'about-us'
		]);
		TypeNew::create([
			'name'=> 'Tuyển dụng',
			'slug'=> 'tuyen-dung'
		]);
		TypeNew::create([
			'name'=> 'Carrier',
			'slug'=> 'carrier'
		]);
	}

}