<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	public function up()
	{
		Schema::create('projects', function(Blueprint $table) {
			$table->increments('id');
			$table->string('ownerId', 10)->index();
			$table->enum('ownerType', array('user', 'group'))->index();
			$table->string('creatorId', 10)->index();
			$table->string('name', 150)->index();
			$table->tinyInteger('privateFlag')->default(0)->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('projects');
	}
}