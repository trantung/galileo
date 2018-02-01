<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldOfStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table){ 
			$table->integer('center_id')->nullable();	
			$table->integer('family_id')->nullable();
			$table->string('fullname')->after('username')->nullable(); 
		 	$table->string('code', 125)->nullable(); 
		 	$table->unique('phone'); 
		 	$table->integer('class_id')->nullable(); 
		 	$table->date('date_study')->nullable();
		 	$table->integer('model_id')->nullable();
		 	$table->string('model_name')->nullable(); 
		 	$table->date('birthday')->nullable(); 
		 	$table->string('gender', 125)->nullable(); 
		 	$table->string('address', 255)->nullable(); 
		 	$table->string('school', 255)->nullable(); 
		 	$table->string('link_fb', 255)->nullable(); 
		 	$table->longText('description')->nullable(); 
		 	$table->string('time_target', 255)->nullable(); 
		 	$table->string('info_user', 255)->nullable(); 
		 	$table->longText('comment')->nullable(); 
		 	$table->string('subject_current', 255)->nullable(); 
		 	$table->longText('program_current')->nullable(); }); 
		}
 	 /** * Reverse the migrations.
 	 * * @return void */ 
 	public function down() 
 	{
		Schema::table('students', function(Blueprint $table){ 
	 	  	$table->dropColumn('center_id');
	 	  	$table->dropColumn('family_id');
		 	$table->dropColumn('fullname'); 
		 	$table->dropColumn('code'); 
		 	$table->dropColumn('phone'); 
		 	$table->dropColumn('class_id'); 
		 	$table->dropColumn('date_study'); 
		 	$table->dropColumn('model_id');
		 	$table->dropColumn('model_name');
		 	$table->dropColumn('birthday'); 
		 	$table->dropColumn('gender'); 
		 	$table->dropColumn('address'); 
		 	$table->dropColumn('school');  
		 	$table->dropColumn('link_fb'); 
		 	$table->dropColumn('description'); 
		 	$table->dropColumn('time_target'); 
		 	$table->dropColumn('info_user'); 
		 	$table->dropColumn('comment');  
		 	$table->dropColumn('subject_current'); 
		 	$table->dropColumn('program_current'); 
	 	}); 
 	}
}
