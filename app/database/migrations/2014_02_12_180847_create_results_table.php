<?php

use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('results', function($table){
			$table->increments('id');
			$table->string('applicant_id');
			$table->string('exam_id');
			$table->string('session_id');
			$table->string('score');
			$table->string('percent');
			$table->string('remark');
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
		Schema::drop('results');
	}

}