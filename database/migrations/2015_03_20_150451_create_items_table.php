<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('project_id');
			$table->string('name');
			$table->string('table_name');
			$table->string('user_id_column_name');
			$table->string('other_criteria');
			$table->string('date_column');
			$table->integer('retention_span_type');
			$table->integer('user_grouping_span_type');
			$table->date('start_date');
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
		Schema::drop('items');
	}

}
