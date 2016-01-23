<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RoleTableSeeder');
		$this->call('AdminTableSeeder');
		$this->call('TypeNewTableSeeder');
		$this->call('NewTableSeeder');
		$this->call('DesContentTableSeeder');
		$this->call('BottomTextTable');
		$this->call('ContactTableSeeder');
		$this->call('IntroduceTableSeeder');
		$this->call('TypeAboutUsTableSeeder');
		$this->call('LanguageTableSeeder');
	}

}
