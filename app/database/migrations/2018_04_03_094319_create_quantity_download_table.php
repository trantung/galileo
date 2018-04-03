<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantityDownloadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
		public function up()
	{
		Schema::create('quantity_downloads', function($table)
		{
			$table->increments('id');
		    $table->integer('class_id')->nullable();
		    $table->integer('subject_id')->nullable();
		    $table->integer('level_id')->nullable();
		    $table->integer('max_account')->nullable();
		    $table->integer('max_document')->nullable();
		    $table->datetime('start_time');
		    $table->datetime('end_time');
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
		Schema::dropIfExists('quantity_downloads');
	}

}
