<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeToClassSubjectLevel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classes', function(Blueprint $table) {
            $table->string('code')->after('id')->nullable();
        });
        Schema::table('subjects', function(Blueprint $table) {
            $table->string('code')->after('id')->nullable();
        });
        Schema::table('levels', function(Blueprint $table) {
            $table->string('code')->after('id')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classes', function(Blueprint $table) {
            $table->dropColumn('code');
        });
		Schema::table('subjects', function(Blueprint $table) {
            $table->dropColumn('code');
        });
		Schema::table('levels', function(Blueprint $table) {
            $table->dropColumn('code');
        });
	}

}
