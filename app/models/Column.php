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

	public function local()
	{
		return $this->hasMany('Relationship', 'localKeyId', 'id');
	}

	public function foreign()
	{
		return $this->hasMany('Relationship', 'foreignKeyId', 'id');
	}

	public function through()
	{
		return $this->hasMany('Relationship', 'throughKeyId', 'id');
	}

}