<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatesTable extends Migration {

	public function up()
	{
		Schema::create('templates', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 150)->index();
			$table->text('data');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('templates');
	}
}