<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildTypesTable extends Migration {

	public function up()
	{
		Schema::create('build_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 150)->index();
			$table->string('keyName', 150)->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('build_types');
	}
}