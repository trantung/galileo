<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('family', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('mom_fullname', 255)->nullable();
            $table->string('mom_phone', 125)->nullable()->unique();
            $table->string('dad_fullname', 255)->nullable();
            $table->string('dad_phone', 125)->nullable()->unique();
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
        Schema::dropIfExists('family');
    }

}
