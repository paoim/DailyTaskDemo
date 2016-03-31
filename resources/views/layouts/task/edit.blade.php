@extends('layouts.app')

@section('title')
Edit Task
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Task #{{ $Task->id }}</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('task/update', $Task->id) }}">
						{!! csrf_field() !!}
						
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $Task->name }}">
								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('project_id') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Project</label>
							<div class="col-md-6">
								<select class="form-control" name="project_id" value="{{ $Task->project_id }}">
									@foreach ($Projects as $Project)
										@if ($Task->project_id == $Project->id)
											<option value="{{ $Project->id }}" selected>{{ $Project->name }}</option>
										@else
											<option value="{{ $Project->id }}">{{ $Project->name }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('project_id'))
									<span class="help-block">
										<strong>{{ $errors->first('project_id') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('task_status_id') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Status</label>
							<div class="col-md-6">
								<select class="form-control" name="task_status_id" value="{{ $Task->task_status_id }}">
									@foreach ($TaskStatusList as $TaskStatus)
										@if ($Task->task_status_id == $TaskStatus->id)
											<option value="{{ $TaskStatus->id }}" selected>{{ $TaskStatus->name }}</option>
										@else
											<option value="{{ $TaskStatus->id }}">{{ $TaskStatus->name }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('task_status_id'))
									<span class="help-block">
										<strong>{{ $errors->first('task_status_id') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('closed_at') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Closed Date</label>
							<div class="col-md-6">
								<input type="date" class="form-control" name="closed_at" value="{{ $Task->closed_at->format('Y-m-d') }}">
								@if ($errors->has('closed_at'))
									<span class="help-block">
										<strong>{{ $errors->first('closed_at') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
								<textarea class="form-control" name="description" rows="10" cols="30">{{ $Task->description }}</textarea>
								@if ($errors->has('description'))
									<span class="help-block">
										<strong>{{ $errors->first('description') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-save"></i>Update
								</button>
								<a href="{{ url('task/detail', $Task->id) }}" class="btn btn-primary">
									<i class="fa fa-btn fa-th"></i>Cancel
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
