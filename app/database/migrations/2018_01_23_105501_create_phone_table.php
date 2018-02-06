<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phone', function($table)
		{
			$table->increments('id');
		    $table->string('phone_student', 125)->nullable()->unique();
		    $table->string('phone_family', 125)->nullable()->unique();
		    $table->integer('status')->nullable();
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
		Schema::drop('phone');
	}

}
