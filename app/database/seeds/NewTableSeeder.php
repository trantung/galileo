<?php

class NewTableSeeder extends Seeder {

	public function run()
	{
		AdminNew::create([
			'name'=> 'Tin tuc 1',
			'slug'=> 'tin-tuc-1',
			'type_new_id' => 1
		]);
		AdminNew::create([
			'name'=> 'Tin tuc 2',
			'slug'=> 'tin-tuc-2',
			'type_new_id' => 2
		]);
		AdminNew::create([
			'name'=> 'Tin tuc 3',
			'slug'=> 'tin-tuc-3',
			'type_new_id' => 1
		]);
	}

}