<?php

class Table_Seed extends BaseModel {

	protected $table = 'table_seeds';
	public $timestamps = true;
	protected $softDelete = true;

	public function template()
	{
		return $this->belongsTo('Template');
	}

}