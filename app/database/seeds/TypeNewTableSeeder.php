<?php

class TypeNewTableSeeder extends Seeder {

	public function run()
	{
		TypeNew::create([
			'name'=> 'share',
			'slug'=> 'share'
		]);
		TypeNew::create([
			'name'=> 'news',
			'slug'=> 'news'
		]);
		TypeNew::create([
			'name'=> 'view',
			'slug'=> 'view'
		]);
	}

}