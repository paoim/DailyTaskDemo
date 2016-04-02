@extends('layouts.app')

@section('title')
Project
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Project</div>

				<div class="panel-body">
					@if (!Auth::guest())
						<div class="col-md-6 col-md-offset-4">
							<a href="{{ url('new') }}" class="btn btn-primary">
								<i class="fa fa-btn fa-plus-square"></i>Create New
							</a>
						</div>
					@endif
					<table class="table table-striped task-table">
						<thead>
							<th>Name</th>
							<th>Status</th>
							<th>Start Date</th>
							@if (Auth::guest())<th>End Date</th>@endif
							<th>Close Date</th>
							@if (Auth::guest())<th>Description</th>@endif
							<th>&nbsp;</th>
						</thead>
						<tbody>
							@if (count($Projects) > 0)
								@foreach ($Projects as $Project)
									<tr>
										<td class="table-text"><div>{{ $Project->name }}</div></td>
										<td class="table-text"><div>{{ $statusOptions[$Project->project_status_id] }}</div></td>
										<td class="table-text"><div>{{ date('Y-m-d', strtotime($Project->started_at)) }}</div></td>
										@if (Auth::guest())<td class="table-text"><div>{{ $Project->ended_at->format('Y-m-d') }}</div></td>@endif
										<td class="table-text"><div>{{ $Project->closed_at->format('Y-m-d') }}</div></td>
										@if (Auth::guest())<td class="table-text"><div>{{ $Project->description }}</div></td>@endif
										<td> <!-- class="button-in-line" -->
											<a href="{{ url('detail', $Project->id) }}" class="btn btn-primary">
												<i class="fa fa-btn fa-th"></i>View
											</a>
											@if (!Auth::guest())
												<a href="{{ url('edit', $Project->id) }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</a>
												<form action="/delete/{{ $Project->id }}" method="POST">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
		
													<button type="submit" class="btn btn-danger">
														<i class="fa fa-trash"></i>Delete
													</button>
												</form>
											@endif
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
					@if (count($Projects) > 0)
						<div class="col-md-6 col-md-offset-4">
							{!! $Projects->links() !!}
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
