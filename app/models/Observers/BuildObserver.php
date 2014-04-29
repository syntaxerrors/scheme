<?php

class BuildObserver {

	private $build;

	public function updated(Build $model)
	{
		$this->build = $model;

		if ( $this->build->status == 'READY' ) {
			$this->buildPrep();
		}

		if ($this->build->status == 'POST_BUILD') {
			$this->postBuild();
		}
	}

	private function buildPrep()
	{
		try {
			// Update build status.
			$this->updateBuildStatus('BUILD_PREP');

			// Get all build objects and send a message to the queue to process them.
			foreach ($this->build->buildObjects as $buildObject) {
				// Queue::push('BuildQueue@buildObject', array('buildId' => $this->build->buildId, 'buildObjectId' => $buildObject->id));
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
	}

	private function postBuild()
	{
		try {
			// Move temp files to public build path.
			$this->build->moveBuildFiles();
			// Delete template build files.
			$this->build->cleanBuild();

			// Update build status to build prep error.
			$this->updateBuildStatus('COMPLETE');
		} catch (Exception $error) {
			$this->logBuildError($error, __METHOD__);

			// Update build status to build prep error.
			$this->updateBuildStatus('POST_BUILD_ERROR');

			// Delete all build files.
			$this->build->cleanBuild();
		}
	}

	private function updateBuildStatus($status)
	{
		// Update build status to build prep error.
		$this->build->status = $status;
		$this->build->save();
	}

	private function logBuildError(Exception $error, $method)
	{
		Log::error("Build Error - [Build:{$this->build->buildId}][Status:{$this->build->status}][Process:{$method}]: {$error->getMessage()}");
	}
}