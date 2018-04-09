<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPageUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('landing_pages', function($table)
		{
			$table->increments('id');
		    $table->string('parent_name', 225)->nullable();
		    $table->string('fullname', 225)->nullable();
		    $table->string('phone', 125)->nullable();
		    $table->string('email', 255)->nullable();
		    $table->integer('class')->nullable();
		    $table->string('period_1', 255)->nullable();
		    $table->string('period_2', 255)->nullable();
		    $table->string('period_3', 255)->nullable();
		    $table->string('period_4', 255)->nullable();
		    $table->string('address', 255)->nullable();
		    $table->integer('check_subject')->nullable();
		    $table->integer('status')->nullable();
		    $table->text('comment')->nullable();
		    $table->string('utm_source', 255)->nullable();
		    $table->string('utm_medium', 255)->nullable();
		    $table->string('utm_campaign', 255)->nullable();
		    $table->string('utm_term', 255)->nullable();
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
		Schema::dropIfExists('landing_pages');
	}

}
