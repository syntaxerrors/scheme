<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelationshipsTable extends Migration {

	public function up()
	{
		Schema::create('relationships', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 150);
			$table->integer('localTableId')->index();
			$table->integer('localKeyId')->index();
			$table->integer('foreignTableId')->index();
			$table->integer('foreignKeyId')->index();
			$table->integer('throughTableId')->nullable()->index();
			$table->integer('throughKeyId')->nullable()->index();
			$table->integer('typeId')->index();
			$table->tinyInteger('namespaceFlag')->default(0);
			$table->string('extraMethods', 150)->nullable();
			$table->tinyInteger('requireKeysFlag')->default(0);
			$table->tinyInteger('errorCheckingFlag')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('relationships');
	}
}