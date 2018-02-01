<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classes_subjects', function(Blueprint $table)
     	{
			$table->increments('id');
			$table->integer('class_id');
			$table->integer('subject_id');
			$table->string('classe_subject_name', 255);
			$table->timestamps();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('classes_subjects');
	}

}
