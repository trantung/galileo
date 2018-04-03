<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevelIdIntoQuantityDownloadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quantity_download', function(Blueprint $table) {
            $table->integer('class_id')->after('id')->nullable();
            $table->integer('subject_id')->after('class_id')->nullable();
            $table->integer('level_id')->after('subject_id')->nullable();
            $table->date('start_time')->after('level_id')->nullable();
            $table->date('end_time')->after('start_time')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quantity_download', function(Blueprint $table) {
            $table->dropColumn('level_id');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
	}

}
