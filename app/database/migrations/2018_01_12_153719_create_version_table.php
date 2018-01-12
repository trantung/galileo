<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_verisons', function($table)
		{
			$table->increments('id');
		    $table->string('name', 256)->nullable();
		    $table->string('code', 256)->nullable();
		    $table->string('url', 256)->nullable();
		    $table->integer('document_id')->nullable();
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
		Schema::drop('document_verisons');
	}

}
