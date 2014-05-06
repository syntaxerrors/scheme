<div id="drawArea">
	@foreach($scheme->tables as $table)
		<div class="panel panel-default dbTable" id='dbtable_{{$table->id}}' style="position: absolute; left: {{$table->postionLeft}}px; top: {{$table->postionTop}}px;">
			<div class="panel-heading">
				{{ $table->name }}
				<div class="panel-btn">
					{{ HTML::linkIcon('/project/create-column/' . $table->id, 'fa fa-plus', null) }}
				</div>
			</div>

			<table class="table table-hover table-condensed" id='{{ $table->id }}'>
				<tbody>
					@if(count($table->columns) > 0)
						@foreach($table->columns as $column)
							<tr id="{{ $column->id }}">
								<td>
									{{ $column->Name }}
								</td>
								<td>
									{{ $column->type->name }} ( {{ $column->value }} )
								</td>
								<td>
									<i class='fa fa-edit'></i> <i class='fa fa-times'></i>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td>
								No Columns
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	@endforeach
</div>


@section('jsInclude')
	{{ HTML::script('http://code.jquery.com/ui/1.10.0/jquery-ui.js') }}
	{{ HTML::script('vendor/jsPlumb/dist/js/jquery.jsPlumb-1.5.5-min.js') }}
@stop
@section('js')
<script>
jsPlumb.ready(function() {
	//jsPlumb default settings
	jsPlumb.importDefaults({
		Container:  "drawArea",
		Anchor:     "AutoDefault",
		Connector:  "Flowchart"
	});

	// Make all tables draggable.
	jsPlumb.draggable($('.dbTable'), {
		stop: function() {
			var postionLeft = $(this).position().left;
			var postionTop = $(this).position().top;

			// If an element is moved into the nav bar
			// move it back down and redraw lines.
			if (postionTop < 57) {
				postionTop = 57;
				$(this).css({top: 57});
				jsPlumb.repaint($(this));
			}

			// If an element is moved to far left
			// move it back to 0 and redraw lines.
			if (postionLeft < 4) {
				postionLeft = 4;
				$(this).css({left: 4});
				jsPlumb.repaint($(this));
			}

			// Send updated postion to database.
			$.post("/project/update-table-location", {
				id: $(this).attr('id'),
				postionLeft: postionLeft,
				postionTop: postionTop
			});
		}
	});

	$('tbody').sortable({
		update: function(event, ui) {
			var order = $(this).sortable('toArray').toString();
			var tableId = $(this).parent('table').attr('id');

			$.post("/project/update-table-order", {
				// id: tableId,
				order: order
			});
		}
	});

	jsPlumb.connect({
	    source:"dbtable_3", 
	    target:"dbtable_4",
	    overlays:[
	    	[ "Label", { label:'One to One', location:0.5} ]
	    ]
	});

	jsPlumb.connect({
	    source:"dbtable_4", 
	    target:"dbtable_5",
	    overlays:[
	    	[ "Label", { label:'One to Many', location:0.5} ]
	    ]
	});

	jsPlumb.connect({
	    source:"dbtable_3", 
	    target:"dbtable_5",
	    overlays:[
	    	[ "Label", { label:'Morph to many', location:0.5} ]
	    ]
	});

	// foreach($project->buildRelationshipsJsPlumb as $relationship)
	// 	jsPlumb.connect($relationship->jsPlumbConfig->toJson());
	// endforeach
});
</script>
@stop

@section('css')
<style>
	.dbTable { z-index: 100; }
	._jsPlumb_overlay { z-index: 5; }
	._jsPlumb_connector { z-index: 4; }
	._jsPlumb_endpoint { z-index: 3; }
</style>
@stop