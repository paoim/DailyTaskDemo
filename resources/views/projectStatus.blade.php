@extends('layouts.app')

@section('title')
Project Status
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Project Status</div>

				<div class="panel-body">
					@if (!Auth::guest())
						<div class="col-md-6 col-md-offset-4">
							<a href="{{ url('projectStatus/new') }}" class="btn btn-primary">
								<i class="fa fa-btn fa-plus-square"></i>Create New
							</a>
						</div>
					@endif
					<table class="table table-striped task-table">
						<thead>
							<th>Name</th>
							<th>Active</th>
							<th>ABV</th>
							<th>&nbsp;</th>
						</thead>
						<tbody>
							@if (count($ProjectStatusList) > 0)
								@foreach ($ProjectStatusList as $ProjectStatus)
									<tr>
										<td class="table-text"><div>{{ $ProjectStatus->name }}</div></td>
										<td class="table-text"><div>{{ $options[$ProjectStatus->active] }}</div></td>
										<td class="table-text"><div>{{ $ProjectStatus->abv }}</div></td>
										<td> <!-- class="button-in-line" -->
											<a href="{{ url('projectStatus/detail', $ProjectStatus->id) }}" class="btn btn-primary">
												<i class="fa fa-btn fa-th"></i>View
											</a>
											@if (!Auth::guest())
												<a href="{{ url('projectStatus/edit', $ProjectStatus->id) }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</a>
												<form action="/projectStatus/delete/{{ $ProjectStatus->id }}" method="POST">
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
					@if (count($ProjectStatusList) > 0)
						<div class="col-md-6 col-md-offset-4">
							{!! $ProjectStatusList->links() !!}
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
