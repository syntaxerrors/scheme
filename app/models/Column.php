<?php

class Column extends BaseModel {

	protected $table = 'columns';
	public $timestamps = true;
	protected $softDelete = true;

	public function type()
	{
		return $this->hasOne('Column_Type');
	}


	public function table()
	{
		return $this->belongsTo('Table');
	}

}