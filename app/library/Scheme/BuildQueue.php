<?php

class BuildQueue {

	public function buildObject($job, $data)
	{
		Log::error(print_r($job, true));
		Log::error(print_r($data, true));

		// $buildObject = Build_Object::where('id', $data['buildObjectId']);

		// if (!$buildObject) {
		// 	// build failed. try to load the build and make it failed.
		// 	$job->delete();
		// }

		// $compiler = new BuildComplier($buildObject);
		// $compiler->run($this->buildObject->type->keyName);

		// $compiler->saveFile();

		// $this->buildObject->status = 'COMPLETE';
		// $this->buildObject->save();
	}
}