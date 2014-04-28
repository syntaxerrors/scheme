<?php

class Relationship extends BaseModel {

	protected $table = 'relationships';
	public $timestamps = true;
	protected $softDelete = true;

	public function local()
	{
		return $this->belongsTo('Table', 'localKeyId');
	}

	public function foreign()
	{
		return $this->belongsTo('Table', 'foreignKeyId');
	}

	public function through()
	{
		return $this->belongsTo('Table', 'throughKeyId');
	}

}