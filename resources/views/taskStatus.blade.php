@extends('layouts.app')

@section('title')
Task Status
@stop

@section('content')
<div class="container">
	@if (!Auth::guest())
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">{{ $taskStatus ? 'Task Status #' . $taskStatus->id : 'New Task Status' }}</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ $taskStatus ? url('taskStatus/update', $taskStatus->id) : url('taskStatus/new') }}">
							{!! csrf_field() !!}
							
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" value="{{ $taskStatus ? $taskStatus->name : old('name') }}">
									@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Status</label>
								<div class="col-md-6">
									<select class="form-control" name="active" value="{{ $taskStatus ? $taskStatus->active : old('active') }}">
										@foreach ($options as $key => $value)
											@if ($taskStatus && $taskStatus->active == $key)
												<option value="{{ $key }}" selected>{{ $value }}</option>
											@elseif ($key == 1 && !$taskStatus)
												<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
												<option value="{{ $key }}">{{ $value }}</option>
											@endif
										@endforeach
									</select>
									@if ($errors->has('active'))
										<span class="help-block">
											<strong>{{ $errors->first('active') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-btn fa-save"></i>{{ $taskStatus ? 'Update' : 'Create' }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endif
	@if (count($taskStatusList) > 0)
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Task Status List</div>

				<div class="panel-body">
					<table class="table table-striped task-table">
						<thead>
							<th>Name</th>
							<th>Status</th>
							<th>&nbsp;</th>
						</thead>
						<tbody>
							@foreach ($taskStatusList as $taskStatus)
								<tr>
									<td class="table-text"><div>{{ $taskStatus->name }}</div></td>
									<td class="table-text"><div>{{ $options[$taskStatus->active] }}</div></td>
									<td class="button-in-line">
										@if (!Auth::guest())
											<a href="{{ url('taskStatus', $taskStatus->id) }}" class="btn btn-primary">
												<i class="fa fa-btn fa-pencil"></i>Edit
											</a>
											<form action="/taskStatus/delete/{{ $taskStatus->id }}" method="POST">
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
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
@endsection
