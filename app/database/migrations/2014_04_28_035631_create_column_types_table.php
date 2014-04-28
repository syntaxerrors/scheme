<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColumnTypesTable extends Migration {

	public function up()
	{
		Schema::create('column_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->string('keyName', 50);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('column_types');
	}
}