<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTablesTable extends Migration {

	public function up()
	{
		Schema::create('tables', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('projectId')->index();
			$table->string('tableName', 150)->index();
			$table->string('description', 150);
			$table->string('className', 150);
			$table->string('namespace', 150)->nullable();
			$table->string('extends', 150)->nullable();
			$table->tinyInteger('timestampsFlag')->default(0);
			$table->tinyInteger('softDeletesFlag')->default(0);
			$table->enum('engine', array('MyISAM', 'InnoDB'));
			$table->string('collation', 150);
			$table->string('partition', 150);
			$table->integer('parentId')->nullable()->index();
			$table->integer('tableTemplateId')->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('tables');
	}
}