<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partners', function($table)
		{
			$table->increments('id');
		    $table->string('partner_name', 225);
            $table->string('email')->unique();
            $table->string('password');
            $table->smallInteger('status')->default(1);
		    $table->rememberToken()->nullable();
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
		Schema::dropIfExists('partners');
	}

}
