<?php

use Illuminate\Database\Migrations\Migration;

class AddLastLoginToUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			// alter the table to add last login column
			$table->dateTime('last_login');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			// drop our last login column
			$table->dropColumn('last_login');
		});
	}

}