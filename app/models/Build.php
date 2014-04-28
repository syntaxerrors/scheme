<?php

class Build extends BaseModel {

	protected $table = 'builds';
	public $timestamps = true;
	protected $softDelete = true;

	public function buildObjects()
	{
		return $this->hasMany('Build_Object');
	}

	// on status update create message to start build if status is ready.

}