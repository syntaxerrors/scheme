<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Create Table</div>
			<div class="panel-body">
				{{ bForm::open() }}
					{{ bForm::hidden('projectId', $project->id, array('id' => 'projectId')) }}
					{{ bForm::text('name', null, array('id' => 'name', 'required' => 'required'), 'Name', 4) }}
					{{ bForm::text('className', null, array('id' => 'className', 'required' => 'required'), 'Class Name', 4) }}
					{{ bForm::text('extends', 'Eloquent', array('id' => 'extends', 'required' => 'required'), 'Extends', 4) }}
					{{ bForm::text('namespace', '', array('id' => 'namespace'), 'Namespace', 4) }}
					{{ bForm::select('engine', $engine, 'innodb', $attributes = array('id' => 'engine','required' => 'required'), 'Engine') }}
					{{ bForm::select('templateId', $template, '', $attributes = array('id' => 'templateId','required' => 'required'), 'Template') }}
					{{ bForm::checkbox('timestampsFlag', 1, true, array('id' => 'timestampsFlag'), 'Timestamps') }}
					{{ bForm::checkbox('softDeletesFlag', 1, true, array('id' => 'softDeletesFlag'), 'Soft Deletes') }}
					{{ bForm::submitReset('Create', 'Reset Fields') }}
				{{ bForm::close() }}
			</div>
		</div>
	</div>
</div>