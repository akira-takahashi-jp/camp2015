<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDefinitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_definitions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('project_id');
			$table->string('table_name');
			$table->string('user_id_column');
			$table->string('date_column');
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
		Schema::drop('user_definitions');
	}

}
