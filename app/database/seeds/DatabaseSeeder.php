<?php

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();

		$this->call('Build_TypeTableSeeder');
		$this->command->info('Build_Type table seeded!');

		$this->call('Build_ColumnTypeSeeder');
		$this->command->info('Column_Type table seeded!');
	}
}