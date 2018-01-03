<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->nullable();
            $table->string('name', 256)->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 256)->nullable();
            $table->string('code', 256)->nullable();
            $table->string('remember_token', 256)->nullable();
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
        Schema::drop('centers');
    }

}
