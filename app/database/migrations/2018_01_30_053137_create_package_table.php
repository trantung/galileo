<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('packages', function($table)
		{
			$table->increments('id');
			$table->string('name', 225);
		    $table->integer('lesson_per_week');
		    $table->integer('total_lesson');
		   	$table->integer('price');
		   	$table->integer('duration');
		   	$table->integer('max_student');
		    $table->tinyInteger('status');
			$table->softDeletes();
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
		Schema::dropIfExists('packages');
	}


}
