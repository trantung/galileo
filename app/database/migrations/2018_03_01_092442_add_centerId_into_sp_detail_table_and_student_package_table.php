<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCenterIdIntoSpDetailTableAndStudentPackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sp_detail', function(Blueprint $table) {
            $table->integer('center_id')->after('id')->nullable();
        });
        Schema::table('student_package', function(Blueprint $table) {
            $table->integer('center_id')->after('id')->nullable();
        });
        
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sp_detail', function(Blueprint $table) {
            $table->dropColumn('center_id');
        });
		Schema::table('student_package', function(Blueprint $table) {
            $table->dropColumn('center_id');
        });
		
	}

}
