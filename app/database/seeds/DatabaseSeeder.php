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
		$this->call('AdminTableSeeder');
		$this->call('SubjectTableSeeder');
		$this->call('ClassTableSeeder');
		$this->call('SubjectClassTableSeeder');
		$this->call('LevelTableSeeder');
		// $this->call('DocumentTypeTableSeeder');
		// $this->call('LessonTableSeeder');
	}

}
