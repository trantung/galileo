<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function($table)
		{
			$table->increments('id');
		    $table->string('name', 225);
		    $table->string('code', 125);
		    $table->integer('class_id');
		    $table->integer('subject_id');
		    $table->integer('level_id');
		    $table->integer('author_by');
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
		Schema::dropIfExists('documents');
	}

}
