<?php

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();

		$this->call('Build_TypeTableSeeder');
		$this->command->info('Build_Type table seeded!');
	}
}