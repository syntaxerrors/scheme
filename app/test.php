<?php

/**
 * This file can be accessed via /test
 */

ppd(Build_Type::where('keyName', '=', 'MIGRATION')->get());

// $table = Project::first();

// $table->buildAll();

// throw new Exception('asdf');

// $stuff = [ 'name' => ['bob','dam'], 'age' => [14, 36]];

// $gname = $stuff['name'];

// foreach( $stuff as $key => $n ) {
// 	echo $key . "<br />";



// Build_Type::create($stuff);