<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelationshipTypesTable extends Migration {

	public function up()
	{
		Schema::create('relationship_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->string('keyName', 50)->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('relationship_types');
	}
}