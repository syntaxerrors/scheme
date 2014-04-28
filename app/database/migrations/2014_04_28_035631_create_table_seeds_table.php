<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableSeedsTable extends Migration {

	public function up()
	{
		Schema::create('table_seeds', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('tableId')->index();
			$table->integer('templateId')->index();
			$table->string('name', 150);
			$table->text('data')->nullable();
			$table->tinyInteger('fakerFlag')->default(0);
			$table->integer('fakerCount')->default(0);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('table_seeds');
	}
}