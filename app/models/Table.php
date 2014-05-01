<?php

class Table extends BaseModel {

	protected $table = 'tables';
	public $timestamps = true;
	protected $softDelete = true;

	public function columns()
	{
		return $this->hasMany('Column', 'tableId');
	}

	public function project()
	{
		return $this->belongsTo('Project', 'projectId');
	}

	public function template()
	{
		return $this->belongsTo('Template', 'tableTemplateId');
	}

	public function seed()
	{
		return $this->hasOne('Table_Seed', 'tableId');
	}


	public function buildModels(Build $builder = null)
	{
		$readyBuild = false;

		if ( is_null($builder) ) {
			$readyBuild = true;

			$builder = $this->project->createBuildInstance();
		}

		$this->createBuildObjectInstance($builder, 'MODEL');

		// If the build was created by this method ready the build otherwise just exit.
		if ( $readyBuild == true ) {
			 $this->project->uppdateBuildStatus($builder, 'READY');
		}

		return true;
	}

	public function buildMigrations(Build $builder = null)
	{
		$readyBuild = false;

		if ( is_null($builder) ) {
			$readyBuild = true;

			$builder =  $this->project->createBuildInstance();
		}

		$this->createBuildObjectInstance($builder, 'MIGRATION');

		// If the build was created by this method ready the build otherwise just exit.
		if ( $readyBuild == true ) {
			 $this->project->uppdateBuildStatus($builder, 'READY');
		}

		return true;
	}

	public function buildSeeds(Build $builder = null)
	{
		$readyBuild = false;

		if ( is_null($builder) ) {
			$readyBuild = true;

			$builder =  $this->project->createBuildInstance();
		}

		$this->createBuildObjectInstance($builder, 'SEED');

		// If the build was created by this method ready the build otherwise just exit.
		if ( $readyBuild == true ) {
			 $this->project->uppdateBuildStatus($builder, 'READY');
		}

		return true;
	}

	public function createBuildObjectInstance(Build $builder, $buildType)
	{
		$buildType = Build_Type::where('keyName', '=', $buildType)->first();

		$buildObject = new Build_Object;
		$buildObject->buildId = $builder->id;
		$buildObject->tableId = $this->id;
		$buildObject->buildTypeId = $buildType->id;// = $buildType;
		$buildObject->status = 'READY';
		$buildObject->save();

		return $buildObject;
	}

}