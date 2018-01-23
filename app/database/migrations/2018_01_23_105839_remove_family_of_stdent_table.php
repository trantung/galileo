<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFamilyOfStdentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table) {
            $table->dropColumn('dad_fullname');
            $table->dropColumn('dad_phone');
            $table->dropColumn('mom_fullname');
            $table->dropColumn('mom_phone');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students', function(Blueprint $table) {
            $table->string('dad_fullname', 255)->nullable();
            $table->string('dad_phone', 125)->nullable()->unique();
            $table->string('mom_fullname', 255)->nullable();
            $table->string('mom_phone', 125)->nullable()->unique();
        });
	}

}
