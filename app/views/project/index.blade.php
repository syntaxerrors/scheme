<div class="panel panel-default">
	<div class="panel-heading">
		Your Projects
		<div class="panel-btn">
			{{ HTML::linkIcon('/project/create/', 'fa fa-plus', null) }}
		</div>
	</div>

	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Name</th>
				<th>Owner</th>
				<th>Creator</th>
				<th>Tables</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($projects as $project)
				<tr>
					<td>{{ HTML::link('/project/view/'. $project->id, $project->name) }}</td>
					@if ($project->owner instanceof User)
						<td>{{ HTML::link('/user/view/'. $project->owner->id, $project->owner->username) }}</td>
					@else
						<td>{{ HTML::link('/group/view/'. $project->id, $project->owner->name) }}</td>
					@endif
					<td>{{ HTML::link('/user/view/'. $project->creator->id, $project->creator->username) }}</td>
					<td>{{ $project->tables->count() }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>