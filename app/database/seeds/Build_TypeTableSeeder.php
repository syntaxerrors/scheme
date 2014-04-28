<?php

class Build_TypeTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('build_types')->delete();

		// Model
		Build_Type::create(array(
				'name' => 'Model',
				'keyName' => 'MODEL'
			));

		// Seed
		Build_Type::create(array(
				'name' => 'Seed',
				'keyName' => 'SEED'
			));

		// Migration
		Build_Type::create(array(
				'name' => 'Migration',
				'keyName' => 'MIGRATION'
			));
	}
}