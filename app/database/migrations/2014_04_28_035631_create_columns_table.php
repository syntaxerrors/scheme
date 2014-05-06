<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColumnsTable extends Migration {

	public function up()
	{
		Schema::create('columns', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('tableId')->index();
			$table->string('name', 150);
			$table->integer('typeId')->index();
			$table->text('defaultValue');
			$table->text('value');
			$table->enum('attribute', array('NONE', 'BINARY', 'UNSIGNED', 'UNSIGNED ZEROFILL'));
			$table->enum('index', array('NONE', 'INDEX', 'PRIMARY_KEY', 'UNIQUE'));
			$table->tinyInteger('nullableFlag')->default(0);
			$table->tinyInteger('autoIncrementFlag')->default(0);
			$table->tinyInteger('fillableFlag')->default(0);
			$table->tinyInteger('visibleFlag')->default(0);
			$table->tinyInteger('guardedFlag')->default(0);
			$table->tinyInteger('hiddenFlag')->default(0);
			$table->integer('order')->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('columns');
	}
}