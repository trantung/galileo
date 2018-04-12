<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAskPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ask_permissions', function($table)
		{
			$table->increments('id');
		    $table->integer('model_id');
		    $table->string('model_name');
		    $table->integer('document_id');
		    $table->string('document_code');
		    $table->integer('status');
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
		Schema::dropIfExists('ask_permissions');
	}

}
