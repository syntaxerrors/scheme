<?php

class Relationship extends BaseModel {

	protected $table = 'relationships';
	public $timestamps = true;
	protected $softDelete = true;

	public function local()
	{
		return $this->belongsTo('Table', 'localTableId');
	}

	public function foreign()
	{
		return $this->belongsTo('Table', 'foreignTableId');
	}

	public function through()
	{
		return $this->belongsTo('Table', 'throughTableId');
	}

}