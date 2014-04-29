<?php

class Build_ObjectObserver {

	private $buildObject;

	public function updated(Build_Object $model)
	{
		$this->buildObject = $model;

		if ( $this->buildObject->status == 'COMPLETE' ) {
			if ( $this->buildObject->build->buildObjectsComplete() == true ) {
				$this->buildObject->build->status = 'POST_BUILD';
				$this->buildObject->build->save();
			}
		}

		if ($this->buildObject->status == 'BUILD_ERROR') {
			$this->buildObject->build->status = 'BUILD_ERROR';
			$this->buildObject->build->save();
		}
	}
}