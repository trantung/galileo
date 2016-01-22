<?php

class IntroduceTableSeeder extends Seeder {

	public function run()
	{
		Introduce::create([
			'css' => 'fa fa-bar-chart',
			'title'=>'Phát triển kinh doanh',
			'description'=>'descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text',
			'position' => 1,
		]);
		Introduce::create([
			'css' => 'fa fa-bar-chart',
			'title'=>'Phát triển kinh doanh en',
			'description'=>'descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text',
			'position' => 1,
		]);
		Introduce::create([
			'css' => 'fa fa-wrench',
			'title'=>'Dịch vụ cao cấp',
			'description'=>'descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text',
			'position' => 2,
		]);
		Introduce::create([
			'css' => 'fa fa-wrench',
			'title'=>'Dịch vụ cao cấp en',
			'description'=>'descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text',
			'position' => 2,
		]);
		Introduce::create([
			'css' => 'fa fa-phone',
			'title'=>'Hỗ trợ khách hàng',
			'description'=>'descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text',
			'position' => 3,
		]);
		Introduce::create([
			'css' => 'fa fa-phone',
			'title'=>'Hỗ trợ khách hàng en',
			'description'=>'descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text descriptions bottom text',
			'position' => 3,
		]);
	}

}