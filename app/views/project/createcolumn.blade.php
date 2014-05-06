<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Create Column</div>
			<div class="panel-body">
				{{ bForm::open() }}
					{{ Form::hidden('tableId', $tableId, array('id' => 'tableId')) }}
					{{ bForm::text('name', null, array('id' => 'name', 'required' => 'required'), 'Name', 4) }}
					{{ bForm::select('typeId', $columnTypes, 'String', $attributes = array('id' => 'typeId','required' => 'required'), 'Type') }}
					{{ bForm::text('defaultValue', null, array('id' => 'defaultValue', 'required' => 'required'), 'Default Value', 4) }}
					{{ bForm::text('value', null, array('id' => 'value', 'required' => 'required'), 'Value', 4) }}
					{{ bForm::select('attribute', $columnAttributes, null, array('id' => 'attribute','required' => 'required'), 'Attribute') }}
					{{ bForm::select('index', $indexes, null, array('id' => 'index','required' => 'required'), 'Index') }}
					{{ bForm::checkbox('nullableFlag', 1, false, array('id' => 'nullableFlag'), 'Nullable') }}
					{{ bForm::checkbox('autoIncrementFlag', 1, false, array('id' => 'autoIncrementFlag'), 'Auto Increment') }}
					{{ bForm::checkbox('fillableFlag', 1, false, array('id' => 'fillableFlag'), 'Fillable') }}
					{{ bForm::checkbox('visibleFlag', 1, false, array('id' => 'visibleFlag'), 'Visible') }}
					{{ bForm::checkbox('guardedFlag', 1, false, array('id' => 'guardedFlag'), 'Guarded') }}
					{{ bForm::checkbox('hiddenFlag', 1, false, array('id' => 'hiddenFlag'), 'Hidden') }}
					{{ bForm::submitReset('Create', 'Reset Fields') }}
				{{ bForm::close() }}
			</div>
		</div>
	</div>
</div>







