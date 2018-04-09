<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteStudentIdAndUserIdOfDocumentLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('document_log', function(Blueprint $table) {
			$table->dropColumn('student_id');
			$table->dropColumn('user_id');
            
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('document_log', function(Blueprint $table) {
            $table->integer('student_id');
            $table->integer('user_id');
        });
	}

}
