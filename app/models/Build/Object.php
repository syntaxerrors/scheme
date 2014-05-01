<?php

class Build_Object extends BaseModel {

	protected $table = 'build_objects';
	public $timestamps = true;
	protected $softDelete = true;

	public function build()
	{
		return $this->belongsTo('Build', 'buildId');
	}

	public function type()
	{
		return $this->belongsTo('Build_Type', 'buildTypeId');
	}

}