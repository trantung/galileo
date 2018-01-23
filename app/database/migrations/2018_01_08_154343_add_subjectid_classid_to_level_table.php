<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectidClassidToLevelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('levels', function(Blueprint $table) {
            $table->integer('subject_id')->after('subject_class_id')->nullable();
            $table->integer('class_id')->after('subject_class_id')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('levels', function(Blueprint $table) {
            $table->dropColumn(['subject_id', 'class_id']);
        });
	}

}
