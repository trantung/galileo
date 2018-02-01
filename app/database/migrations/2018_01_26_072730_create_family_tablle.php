<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyTablle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
    {
        Schema::create('family', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('grup_id')->nullable();
            $table->string('username', 255)->nullable()->unique();
            $table->string('password', 255)->nullable();
            $table->string('email', 255)->nullable()->unique();
            $table->string('gender', 255)->nullable();
            $table->string('mom_phone', 255)->nullable()->unique();
            $table->string('mom_fullname', 255)->nullable();
            $table->string('dad_phone', 255)->nullable()->unique();
            $table->string('dad_fullname', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('family');
    }

}
