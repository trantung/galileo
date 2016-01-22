<?php

class ContactTableSeeder extends Seeder {

	public function run()
	{
		Contact::create([
				'description'=>'Công ty Cổ phần truyền thông ABC
				Địa chỉ: P501, Tầng 5, Tòa nhà văn phòng, Số 5B/55, Huỳnh Thúc Kháng, Phường Láng Hạ, Quận Đống Đa, Hà Nội
				Tel: (84-4) 3.775.4334 - Fax: (84-4) 3512 1804',
				'slug'=>'lien-he',
			]);
		Contact::create([
				'description'=>'ABC company
				Địa chỉ: P501, Tầng 5, Tòa nhà văn phòng, Số 5B/55, Huỳnh Thúc Kháng, Phường Láng Hạ, Quận Đống Đa, Hà Nội
				Tel: (84-4) 3.775.4334 - Fax: (84-4) 3512 1804',
				'slug'=>'contact',
			]);
	}

}