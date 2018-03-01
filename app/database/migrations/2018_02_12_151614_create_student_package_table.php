<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_package', function($table)
		{
			$table->increments('id');
		    $table->integer('student_id');
		    $table->integer('class_id');
		    $table->integer('subject_id');
		    $table->integer('level_id');
		    $table->integer('package_id');
		    $table->integer('money_paid');
		    $table->integer('time_id');
		    $table->integer('lesson_total');
		    $table->integer('lesson_code');
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
		Schema::dropIfExists('student_package');
	}

}
