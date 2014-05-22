<?php

class Build_ColumnTypeSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		//DB::table('column_types')->delete();

		$new = new Column_Type;
		$new->name = 'Increments';
		$new->keyName = 'increments';
		$new->catagoryId = 1;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Big Increments';
		$new->keyName = 'bigIncrements';
		$new->catagoryId = 1;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Time Stamps';
		$new->keyName = 'timestamps';
		$new->catagoryId = 1;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Soft Deletes';
		$new->keyName = 'softDeletes';
		$new->catagoryId = 1;
		$new->save();

		$new = new Column_Type;
		$new->name = 'String';
		$new->keyName = 'string';
		$new->catagoryId = 2;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Text';
		$new->keyName = 'text';
		$new->catagoryId = 2;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Tiny Integer';
		$new->keyName = 'tinyInteger';
		$new->catagoryId = 3;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Small Integer';
		$new->keyName = 'smallInteger';
		$new->catagoryId = 3;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Medium Integer';
		$new->keyName = 'mediumInteger';
		$new->catagoryId = 3;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Integer';
		$new->keyName = 'integer';
		$new->catagoryId = 3;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Big Integer';
		$new->keyName = 'bigInteger';
		$new->catagoryId = 3;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Float';
		$new->keyName = 'float';
		$new->catagoryId = 3;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Decimal';
		$new->keyName = 'decimal';
		$new->catagoryId = 3;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Boolean';
		$new->keyName = 'boolean';
		$new->catagoryId = 3;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Enum';
		$new->keyName = 'enum';
		$new->catagoryId = 4;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Date';
		$new->keyName = 'date';
		$new->catagoryId = 6;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Date time';
		$new->keyName = 'datetime';
		$new->catagoryId = 6;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Time';
		$new->keyName = 'time';
		$new->catagoryId = 6;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Time stamp';
		$new->keyName = 'timestamp';
		$new->catagoryId = 6;
		$new->save();

		$new = new Column_Type;
		$new->name = 'Binary';
		$new->keyName = 'binary';
		$new->catagoryId = 5;
		$new->save();
	}
}