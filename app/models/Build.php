<?php

class Build extends BaseModel {

	protected $table = 'builds';
	public $timestamps = true;
	protected $softDelete = true;

	public function buildObjects()
	{
		return $this->hasMany('Build_Object', 'buildId');
	}

	// on status update create message to start build if status is ready.
	
	public function buildObjectsComplete()
	{
		foreach ($this->buildObjects as $buildObject) {
			if ($buildObject->status != 'COMPLETE') {
				return false;
			}
		}

		return true;
	}

}