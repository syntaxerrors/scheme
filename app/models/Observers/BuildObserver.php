`<?php

class BuildObserver {

	private $build;

	public function updated(Build $model)
	{
		$this->build = $model;

		if ( $this->build->status == 'READY' ) {
			$this->logBuildMessage('Sending Build Prep Message.');

			Queue::push('BuildQueue@buildPrep', array('buildId' => $this->build->buildId));

			$this->logBuildMessage('Build Prep Message Sent');
		}

		if ($this->build->status == 'POST_BUILD') {
			$this->postBuild();
		}
	}

	private function postBuild()
	{
		try {
			// Move temp files to public build path.
			// $this->build->moveBuildFiles();
			// Delete template build files.
			// $this->build->cleanBuild();

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

	private function logBuildMessage($message)
	{
		Log::debug("Build Message - [Build:{$this->build->buildId}]: {$message}");
	}

	private function logBuildError(Exception $error, $method)
	{
		Log::error("Build Error - [Build:{$this->build->buildId}][Status:{$this->build->status}][Process:{$method}]: {$error->getMessage()}");
	}
}