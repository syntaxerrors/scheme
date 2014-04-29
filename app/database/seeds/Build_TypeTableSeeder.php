<?php

class Build_TypeTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		//DB::table('build_types')->delete();

		$new = new Build_Type;
		$new->name = 'Model';
		$new->keyName = 'MODEL';
		$new->save();

		$new = new Build_Type;
		$new->name = 'Migration';
		$new->keyName = 'MIGRATION';
		$new->save();

		$new = new Build_Type;
		$new->name = 'Seed';
		$new->keyName = 'SEED';
		$new->save();
	}
}