<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTablesTable extends Migration {

	public function up()
	{
		Schema::create('tables', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('projectId')->index();
			$table->string('name', 150)->index();
			$table->string('className', 150);
			$table->string('namespace', 150)->nullable();
			$table->string('extends', 150)->nullable();
			$table->tinyInteger('timestampsFlag')->default(0);
			$table->tinyInteger('softDeletesFlag')->default(0);
			$table->enum('engine', array('myisam', 'innodb'));
			$table->integer('tableTemplateId')->index();
			$table->integer('postionLeft');
			$table->integer('postionTop');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('tables');
	}
}