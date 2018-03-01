<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessPermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('access_permission', function($table)
		{
			$table->increments('id');
		    $table->string('model_name', 256)->nullable();
		    $table->integer('model_id')->nullable();
		    $table->integer('permission_id')->nullable();
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
		Schema::drop('access_permission');
	}

}
