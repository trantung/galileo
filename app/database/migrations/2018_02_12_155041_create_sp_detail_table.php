<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sp_detail', function($table)
		{
			$table->increments('id');
		    $table->integer('student_package_id');
		    $table->integer('user_id');
		    $table->integer('student_id');
		    $table->integer('class_id');
		    $table->integer('subject_id');
		    $table->integer('level_id');
		    $table->integer('package_id');
		    $table->integer('time_id');
		    $table->integer('lesson_code');
		    $table->integer('status');
		    $table->string('lesson_date');
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
		Schema::dropIfExists('sp_detail');
	}

}
