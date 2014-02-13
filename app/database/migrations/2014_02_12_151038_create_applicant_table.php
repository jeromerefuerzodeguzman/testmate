<?php

use Illuminate\Database\Migrations\Migration;

class CreateApplicantTable extends Migration {

	public function up()
	{
		Schema::create('applicants', function($table){
			$table->increments('id');
			$table->string('exam_id');
			$table->string('name');
			$table->string('code');
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
		Schema::drop('applicants');
	}

}