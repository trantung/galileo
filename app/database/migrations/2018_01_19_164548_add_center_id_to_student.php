<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCenterIdToStudent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table) {
            $table->integer('center_id')->after('class_id')->nullable();
            $table->string('model_name')->after('center_id')->nullable();
            $table->integer('model_id')->after('model_name')->nullable();
            $table->dropColumn('author');
        });

        Schema::table('student_level', function(Blueprint $table) {
            $table->integer('status')->nullable();

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
            $table->dropColumn('center_id');
            $table->dropColumn('model_name');
            $table->dropColumn('model_id');
            $table->integer('author')->nullable();
        });
        Schema::table('student_level', function(Blueprint $table) {
            $table->dropColumn('status');
        });
	}

}
