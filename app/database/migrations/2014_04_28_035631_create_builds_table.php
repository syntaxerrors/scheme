<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildsTable extends Migration {

	public function up()
	{
		Schema::create('builds', function(Blueprint $table) {
			$table->increments('id');
			$table->string('ownerId', 10)->index();
			$table->enum('ownerType', array('user', 'group'))->index();
			$table->string('creatorId', 10)->index();
			$table->string('projectId', 10)->index();
			$table->string('buildId', 10)->index();
			$table->string('status')->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('builds');
	}
}