@extends('layouts.app')

@section('title')
Task Status
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Task Status</div>

				<div class="panel-body">
					@if (!Auth::guest())
						<div class="col-md-6 col-md-offset-4">
							<a href="{{ url('taskStatus/new') }}" class="btn btn-primary">
								<i class="fa fa-btn fa-plus-square"></i>Create New
							</a>
						</div>
					@endif
					<table class="table table-striped task-table">
						<thead>
							<th>Name</th>
							<th>Status</th>
							<th>&nbsp;</th>
						</thead>
						<tbody>
							@if (count($TaskStatusList) > 0)
								@foreach ($TaskStatusList as $TaskStatus)
									<tr>
										<td class="table-text"><div>{{ $TaskStatus->name }}</div></td>
										<td class="table-text"><div>{{ $options[$TaskStatus->active] }}</div></td>
										
										<td> <!-- class="button-in-line" -->
											<a href="{{ url('taskStatus/detail', $TaskStatus->id) }}" class="btn btn-primary">
												<i class="fa fa-btn fa-th"></i>View
											</a>
											@if (!Auth::guest())
												<a href="{{ url('taskStatus/edit', $TaskStatus->id) }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</a>
												<form action="/taskStatus/delete/{{ $TaskStatus->id }}" method="POST">
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
					@if (count($TaskStatusList) > 0)
						<div class="col-md-6 col-md-offset-4">
							{!! $TaskStatusList->links() !!}
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
