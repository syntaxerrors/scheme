<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildObjectsTable extends Migration {

	public function up()
	{
		Schema::create('build_objects', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('buildId')->index();
			$table->integer('tableId')->index();
			$table->integer('buildTypeId');
			$table->string('status')->index();
			$table->string('filePath');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('build_objects');
	}
}