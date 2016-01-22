<?php

class NewTableSeeder extends Seeder {

	public function run()
	{
		AdminNew::create([
			'name'=> 'giới thiệu công ty',
			'slug'=> 'gioi-thieu-cong-ty',
			'type_new_id' => 1
		]);
		AdminNew::create([
			'name'=> 'about-us',
			'slug'=> 'about-us-company',
			'type_new_id' => 1
		]);
		AdminNew::create([
			'name'=> 'Tin tuyển dụng',
			'slug'=> 'tin-tuyen-dung',
			'type_new_id' => 3
		]);
		AdminNew::create([
			'name'=> 'New carrier',
			'slug'=> 'new-carrier',
			'type_new_id' => 3
		]);
	}

}