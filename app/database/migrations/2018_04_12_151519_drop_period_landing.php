<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPeriodLanding extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('landing_pages', function(Blueprint $table) {
			$table->dropColumn('period_1');
			$table->dropColumn('period_2');
			$table->dropColumn('period_3');
			$table->dropColumn('period_4');
            
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('landing_pages', function(Blueprint $table) {
            $table->string('period_1');
            $table->string('period_2');
            $table->string('period_3');
            $table->string('period_4');
        });
	}

}
