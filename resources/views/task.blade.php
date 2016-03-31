@extends('layouts.app')

@section('title')
Task
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Task</div>

				<div class="panel-body">
					@if (!Auth::guest())
						<div class="col-md-6 col-md-offset-4">
							<a href="{{ url('task/new') }}" class="btn btn-primary">
								<i class="fa fa-btn fa-plus-square"></i>Create New
							</a>
						</div>
					@endif
					<table class="table table-striped task-table">
						<thead>
							<th>Name</th>
							<th>Project</th>
							<th>Status</th>
							<th>Close Date</th>
							<th>Description</th>
							<th>&nbsp;</th>
						</thead>
						<tbody>
							@if (count($Tasks) > 0)
								@foreach ($Tasks as $Task)
									<tr>
										<td class="table-text"><div>{{ $Task->name }}</div></td>
										<td class="table-text"><div>{{ $projectOptions[$Task->project_id] }}</div></td>
										<td class="table-text"><div>{{ $statusOptions[$Task->task_status_id] }}</div></td>
										<td class="table-text"><div>{{ $Task->closed_at->format('Y-m-d') }}</div></td>
										<td class="table-text"><div>{{ $Task->description }}</div></td>
										<td> <!-- class="button-in-line" -->
											<a href="{{ url('task/detail', $Task->id) }}" class="btn btn-primary">
												<i class="fa fa-btn fa-th"></i>View
											</a>
											@if (!Auth::guest())
												<a href="{{ url('task/edit', $Task->id) }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</a>
												<form action="/task/delete/{{ $Task->id }}" method="POST">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
		
													<button type="submit" class="btn btn-danger">
														<i class="fa fa-btn fa-trash"></i>Delete
													</button>
												</form>
											@endif
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
