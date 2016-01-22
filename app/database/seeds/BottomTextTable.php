<?php

class BottomTextTable extends Seeder {

	public function run()
	{
		BottomText::create([
				'title' => 'giới thiệu bottom text',
				'description'=>'giới thiệu bottom text',
				'link'=>'http://choinhanh.vn/',
				'status' => 2,
		]);
		BottomText::create([
				'title' => 'title bottom text',
				'description'=>'descriptions bottom text',
				'link'=>'http://choinhanh.vn/',
				'status' => 2,
		]);
	}

}