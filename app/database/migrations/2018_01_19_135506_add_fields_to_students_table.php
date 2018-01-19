<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table) {
            $table->integer('fullname')->after('username')->nullable();
            $table->string('code', 125)->nullable();
            $table->unique('phone');
            $table->integer('class_id')->nullable();
            $table->date('date_study')->nullable();
            $table->string('author', 255)->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender', 125)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('school', 255)->nullable();
            $table->string('dad_fullname', 255)->nullable();
            $table->string('dad_phone', 125)->nullable()->uniquie();
            $table->string('mom_fullname', 255)->nullable();
            $table->string('mom_phone', 125)->nullable()->unique();
            $table->string('link_fb', 255)->nullable();
            $table->longText('description')->nullable();
            $table->string('time_target', 255)->nullable();
            $table->string('info_user', 255)->nullable();
            $table->longText('comment')->nullable();
            $table->integer('number_program')->nullable();
            $table->longText('program_learned')->nullable();
            $table->string('subject_current', 255)->nullable();
            $table->longText('program_current')->nullable();



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
            $table->dropColumn('fullname');
            $table->dropColumn('code');
            $table->dropColumn('phone');
            $table->dropColumn('class_id');
            $table->dropColumn('date_study');
            $table->dropColumn('author');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('address');
            $table->dropColumn('school');
            $table->dropColumn('dad_fullname');
            $table->dropColumn('dad_phone');
            $table->dropColumn('mom_fullname');
            $table->dropColumn('mom_phone');
            $table->dropColumn('link_fb');
            $table->dropColumn('description');
            $table->dropColumn('time_target');
            $table->dropColumn('info_user');
            $table->dropColumn('comment');
            $table->dropColumn('number_program');
            $table->dropColumn('program_learned');
            $table->dropColumn('subject_current');
            $table->dropColumn('program_current');
        });
	}

}
