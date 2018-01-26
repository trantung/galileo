<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
            $table->string('phone', 35)->after('username');
            $table->date('start_date')->after('username')->nullable();
            $table->date('end_date')->after('username')->nullable();
            $table->date('birth_day')->after('username')->nullable();
            $table->string('current_address', 225)->after('username')->nullable();
            $table->string('address', 225)->after('username')->nullable();
            $table->integer('id_number')->after('username')->nullable();
            $table->integer('id_date')->after('username')->nullable();
            $table->integer('id_provide')->after('username')->nullable();
            $table->string('job', 225)->after('username')->nullable();
            $table->string('full_name', 225)->after('username')->nullable();
            $table->string('personal_email', 225)->after('username')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
            $table->dropColumn(['personal_email', 'phone', 'start_date', 'end_date', 'birth_day', 'current_address', 'address', 'id_number', 'id_date', 'id_provide', 'job', 'full_name']);
        });
	}

}
