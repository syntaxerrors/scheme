<?php

class Column extends BaseModel {

	protected $table = 'columns';
	public $timestamps = true;
	protected $softDelete = true;

	public function type()
	{
		return $this->belongsTo('Column_Type', 'typeId');
	}


	public function table()
	{
		return $this->belongsTo('Table', 'tableId');
	}

}