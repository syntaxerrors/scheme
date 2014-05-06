<?php

class Relationship_Builder {

	private $relationshipTypes;

	public function function __construct() {
		$this->relationshipTypes = Relationship_Type::all();
	}

	public function addOneToOne($localModel, $foreignModel, $localKey = null, $foreignKey = null)
	{
		if ( $localKey == null || $foreignKey == null ) {
			$keys = $this->guessKeys($localModel, $foreignModel);

			if ($localKey == null) {
				$localKey = $keys->local;
			}

			if ($foreignKey == null) {
				$foreignKey = $keys->foreign;
			}
		}

		// create has one on local table.
		$localRelationship = new Relationship;
		$localRelationship->typeId = $this->relationshipTypes->firstWhere('keyName', 'HAS_ONE');
		$localRelationship->localTableId = $localModel->id;
		$localRelationship->localKeyId = $localKey->id;
		$localRelationship->foreignTableId = $foreignModel->Id;
		$localRelationship->foreignKeyId = $foreignKey->id;
		$localRelationship->save();

		// create belongs to on foreign table
		$foreignRelationship = new Relationship;
		$foreignRelationship->typeId = $this->relationshipTypes->firstWhere('keyName', 'BELONGS_TO');
		$foreignRelationship->localTableId = $foreignModel->id;
		$foreignRelationship->localKeyId = $foreignKey->id;
		$foreignRelationship->foreignTableId = $localModel->Id;
		$foreignRelationship->foreignKeyId = $localKey->id;
		$foreignRelationship->save();

	}

	public function addOneToMany($localModel, $foreignModel, $localKey = null, $foreignKey = null)
	{
		if ( $localKey == null || $foreignKey == null ) {
			$keys = $this->guessKeys($localModel, $foreignModel);

			if ($localKey == null) {
				$localKey = $keys->local;
			}

			if ($foreignKey == null) {
				$foreignKey = $keys->foreign;
			}
		}
		// hasmany

		// create belongs to on foreign table
		$foreignRelationship = new Relationship;
		$foreignRelationship->typeId = $this->relationshipTypes->firstWhere('keyName', 'BELONGS_TO');
		$foreignRelationship->localTableId = $foreignModel->id;
		$foreignRelationship->localKeyId = $foreignKey->id;
		$foreignRelationship->foreignTableId = $localModel->Id;
		$foreignRelationship->foreignKeyId = $localKey->id;
		$foreignRelationship->save();
	}

	public function addManyToMany($localModel, $foreignModel, $localKey = null, $foreignKey = null)
	{
		if ( $localKey == null || $foreignKey == null ) {
			$keys = $this->guessKeys($localModel, $foreignModel);

			if ($localKey == null) {
				$localKey = $keys->local;
			}

			if ($foreignKey == null) {
				$foreignKey = $keys->foreign;
			}
		}
		// belongsToMany
		// create pivot table or use one they want.
		// belongsToMany
	}

	public function addHasManyThrough($localModel, $foreignModel, $throughModel, $localKey = null, $foreignKey = null, $throughKey = null)
	{
		if ( $localKey == null || $foreignKey == null ) {
			$keys = $this->guessKeys($localModel, $foreignModel);

			if ($localKey == null) {
				$localKey = $keys->local;
			}

			if ($foreignKey == null) {
				$foreignKey = $keys->foreign;
			}
		}
		// hasManyThrough
		// hasManyThrough
		// pivot - has many
		// pivot - has many
	}

	public function addPolymorphic($localModel, $foreignModel, $localKey = null, $foreignKey = null)
	{
		if ( $localKey == null || $foreignKey == null ) {
			$keys = $this->guessKeys($localModel, $foreignModel);

			if ($localKey == null) {
				$localKey = $keys->local;
			}

			if ($foreignKey == null) {
				$foreignKey = $keys->foreign;
			}
		}
		// morphTo
		// morphMany (This should be recursive)
		// morphMany (This should be recursive)
	}

	public function addPolymorphicMany($localModel, $foreignModel, $localKey = null, $foreignKey = null)
	{
		if ( $localKey == null || $foreignKey == null ) {
			$keys = $this->guessKeys($localModel, $foreignModel);

			if ($localKey == null) {
				$localKey = $keys->local;
			}

			if ($foreignKey == null) {
				$foreignKey = $keys->foreign;
			}
		}
		// morphToMany
		// morphedByMany (This should be recursive)
		// morphedByMany (This should be recursive)
	}

	public function addForeignKeyConstraint($localModel, $localKey, $foreignModel, $foreignKey, $onDelete = null, $onUpdate = null)
	{
		if ( $localKey == null || $foreignKey == null ) {
			$keys = $this->guessKeys($localModel, $foreignModel);

			if ($localKey == null) {
				$localKey = $keys->local;
			}

			if ($foreignKey == null) {
				$foreignKey = $keys->foreign;
			}
		}

	}

	private function guessKeys($localModel, $foreignModel)
	{


		throw new Exception('Unable to guess keys. Please provide local and foreign keys.');
	}
}