<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Create Project</div>
			<div class="panel-body">
				{{ bForm::open() }}
					{{ bForm::text('name', null, array('id' => 'name', 'required' => 'required'), 'Name', 4) }}
					{{ bForm::select('owner', $owners, null, $attributes = array('id' => 'ownerType','required' => 'required'), 'Owner') }}
					{{ bForm::checkbox('privateFlag', 1, false, array('id' => 'privateFlag'), 'Private') }}
					{{ bForm::submitReset('Create', 'Reset Fields') }}
				{{ bForm::close() }}
			</div>
		</div>
	</div>
</div>