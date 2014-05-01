<?php

class BuildQueue {

	protected $build;

	public function buildPrep($job, $data)
	{
		$this->build = Build::where('buildId', $data['buildId'])->first();

		try {
			$this->logBuildMessage('Starting build prep.');
			// Update build status.
			$this->updateBuildStatus('BUILD_PREP');

			$this->logBuildMessage('Sending build object messages.');
			// Get all build objects and send a message to the queue to process them.
			foreach ($this->build->buildObjects as $buildObject) {
				Queue::push('BuildQueue@buildObject', array('buildId' => $this->build->buildId, 'buildObjectId' => $buildObject->id));
			}

			// Update the build to in progress.
			$this->updateBuildStatus('IN_PROGRESS');
		} catch (Exception $error) {
			$this->logBuildError($error, __METHOD__);

			// Update build status to build prep error.
			$this->updateBuildStatus('BUILD_PREP_ERROR');

			// Delete all build files.
			// $this->build->cleanBuild();
		}

		$this->logBuildMessage('Build prep complete deleting job.');

		$job->delete();
	}


	public function buildObject($job, $data)
	{
		$buildObject = Build_Object::find($data['buildObjectId']);
		$this->build = $buildObject->build;
		
		if (!$buildObject) {
			// build failed. try to load the build and make it failed.
			$job->delete();
			return false;
		}

		if ( $buildObject->build->status == 'BUILD_PREP' ) {
			$this->logBuildMessage('Build not in progress releasing job.');

			$job->release();
			return false;
		}

		

		$this->logBuildMessage('Starting build object.');

		// $compiler = new BuildComplier($buildObject);
		// $compiler->run($this->buildObject->type->keyName);

		// $compiler->saveFile();

		$buildObject->status = 'COMPLETE';
		$buildObject->save();

		$this->logBuildMessage('Build object compelte deleting job.');

		$job->delete();
	}

	private function updateBuildStatus($status)
	{
		// Update build status to build prep error.
		$this->build->status = $status;
		$this->build->save();
	}

	private function logBuildMessage($message)
	{
		Log::debug("Build Message - [Build:{$this->build->buildId}]: {$message}");
	}

	private function logBuildError(Exception $error, $method)
	{
		Log::error("Build Error - [Build:{$this->build->buildId}][Status:{$this->build->status}][Process:{$method}]: {$error->getMessage()}");
	}
}