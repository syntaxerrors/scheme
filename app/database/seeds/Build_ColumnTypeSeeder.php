<?php

class Build_ColumnTypeSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		//DB::table('column_types')->delete();

		$new = new Column_Type;
		$new->name = 'Increments';
		$new->keyName = 'increments';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Big Increments';
		$new->keyName = 'bigIncrements';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Time Stamps';
		$new->keyName = 'timestamps';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Soft Deletes';
		$new->keyName = 'softDeletes';
		$new->save();

		$new = new Column_Type;
		$new->name = 'String';
		$new->keyName = 'string';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Text';
		$new->keyName = 'text';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Tiny Integer';
		$new->keyName = 'tinyInteger';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Small Integer';
		$new->keyName = 'smallInteger';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Medium Integer';
		$new->keyName = 'mediumInteger';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Integer';
		$new->keyName = 'integer';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Big Integer';
		$new->keyName = 'bigInteger';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Float';
		$new->keyName = 'float';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Decimal';
		$new->keyName = 'decimal';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Boolean';
		$new->keyName = 'boolean';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Enum';
		$new->keyName = 'enum';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Date';
		$new->keyName = 'date';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Date time';
		$new->keyName = 'datetime';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Time';
		$new->keyName = 'time';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Time stamp';
		$new->keyName = 'timestamp';
		$new->save();

		$new = new Column_Type;
		$new->name = 'Binary';
		$new->keyName = 'binary';
		$new->save();
	}
}