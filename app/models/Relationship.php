<?php

class Relationship extends BaseModel {

	protected $table = 'relationships';
	
	public $timestamps = true;
	
	protected $softDelete = true;

	protected $requireKeys = false;

	public function type()
	{
		return $this->belongsTo('Relationship_Type', 'typeId');
	}

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

	//  add a mehtod to check if local or foreign keys are needed in relation ship methods.
	//  all user to over ride this to true.

}