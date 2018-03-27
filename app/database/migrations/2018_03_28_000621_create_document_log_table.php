<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_log', function($table)
		{
			$table->increments('id');
			$table->integer('parent_id')->nullable();
		    $table->integer('model_id')->nullable();
			$table->string('model_name', 125)->nullable();
			$table->integer('type_id')->nullable();
		    $table->string('name', 225)->nullable();
		    $table->string('code', 125)->nullable();
		    $table->string('file_url', 125)->nullable();
		    $table->integer('student_id')->nullable();
		    $table->integer('class_id')->nullable();
		    $table->integer('subject_id')->nullable();
		    $table->integer('level_id')->nullable();
		    $table->integer('user_id')->nullable();
		    $table->integer('lesson_id')->nullable();
		    $table->integer('order')->nullable();
		    $table->integer('quantity_download')->default(0);
		    $table->integer('day')->nullable();
		    $table->integer('month')->nullable();
		    $table->integer('year')->nullable();
		    $table->tinyInteger('status')->default(1);
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
		Schema::dropIfExists('document_additionals');
	}


}
