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
		    $table->string('code', 25)->nullable();
		    $table->integer('student_id')->nullable();
		    $table->integer('class_id')->nullable();
		    $table->integer('subject_id')->nullable();
		    $table->integer('level_id')->nullable();
		    $table->integer('package_id')->nullable();
		    $table->integer('money_paid')->nullable();
		    $table->integer('time_id')->nullable();
		    $table->integer('lesson_total')->nullable();
		    $table->integer('lesson_code')->nullable();
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
