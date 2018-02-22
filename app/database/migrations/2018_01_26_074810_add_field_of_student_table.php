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
		});
	}

 	 /** * Reverse the migrations.
 	 * * @return void */ 
 	public function down() 
 	{
		Schema::table('students', function(Blueprint $table){ 
	 	  	$table->dropColumn('center_id', 'family_id', 'fullname', 'code', 'phone', 'class_id', 'date_study', 'model_id', 'model_name', 'birthday', 'gender', 'address', 'school', 'link_fb', 'description', 'time_target', 'info_user', 'comment');  
	 	}); 
 	}
}
