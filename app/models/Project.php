<?php

class Project extends BaseModel {

	protected $table = 'projects';
	public $timestamps = true;
	protected $softDelete = true;

	public function tables()
	{
		return $this->hasMany('Table', 'projectId');
	}

	public function owner()
	{
		if ( $this->ownerType == 'user' ) {
			return $this->belongsTo('User', 'ownerId');
		} else {
			return $this->belongsTo('Group', 'ownerId');
		}
	}

	public function creator()
	{
		return $this->belongsTo('User', 'creatorId');
	}

	public function buildAll()
	{
		$builder = $this->createBuildInstance();

		$this->buildModels($builder);
		$this->buildMigrations($builder);
		$this->buildSeeds($builder);

		$this->uppdateBuildStatus($builder, 'READY');

		return true;
	}

	public function buildModels(Build $builder = null)
	{
		$readyBuild = false;

		if ( is_null($builder) ) {
			$readyBuild = true;

			$builder = $this->createBuildInstance();
		}

		foreach ($this->tables as $table) {
			$table->buildModels($builder);
		}


		// If the build was created by this method ready the build otherwise just exit.
		if ( $readyBuild == true ) {
			$this->uppdateBuildStatus($builder, 'READY');
		}

		return true;
	}

	public function buildMigrations(Build $builder = null)
	{
		$readyBuild = false;

		if ( is_null($builder) ) {
			$readyBuild = true;

			$builder = $this->createBuildInstance();
		}

		foreach ($this->tables as $table) {
			$table->buildMigrations($builder);
		}


		// If the build was created by this method ready the build otherwise just exit.
		if ( $readyBuild == true ) {
			$this->uppdateBuildStatus($builder, 'READY');
		}

		return true;
	}

	public function buildSeeds(Build $builder = null)
	{
		$readyBuild = false;

		if ( is_null($builder) ) {
			$readyBuild = true;

			$builder = $this->createBuildInstance();
		}

		foreach ($this->tables as $table) {
			$table->buildSeeds($builder);
		}


		// If the build was created by this method ready the build otherwise just exit.
		if ( $readyBuild == true ) {
			$this->uppdateBuildStatus($builder, 'READY');
		}

		return true;
	}

	public function createBuildInstance()
	{
		$builder = new Build;
		$builder->ownerId = 1;//$this->activeUser->id;
		$builder->ownerType = 'user'; // right now user groups are not build in.
		$builder->creatorId = 1;//$this->activeUser->id;
		// $builder->projectId = $this->id;
		$builder->buildId = str_random(10);
		$builder->status = 'new';
		$builder->save();

		return $builder;
	}

	public function uppdateBuildStatus(Build $builder, $status)
	{
		$builder->status = $status;
		$builder->save();

		return $builder;
	}

}