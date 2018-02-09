<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id')->nullable();
            $table->string('fullname', 255);
            $table->string('username', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('phone', 255)->unique()->nullable();
            $table->string('code', 125)->nullable();
            $table->integer('center_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->date('date_study')->nullable();
            $table->string('model_name', 255)->nullable();
            $table->integer('model_id')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender', 125)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('school', 255)->nullable();
            $table->string('link_fb', 255)->nullable();
            $table->longText('description')->nullable();
            $table->string('time_target', 255)->nullable();
            $table->string('info_user', 255)->nullable();
            $table->longText('comment')->nullable();
            $table->string('remember_token', 255)->nullable();
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
		Schema::drop('students');
	}

}
