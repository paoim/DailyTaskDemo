@extends('layouts.app')

@section('title')
Task
@stop

@section('content')
<div class="container">
	@if (!Auth::guest())
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">{{ $task ? 'Update Task #' .$task->id : 'New Task' }}</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ $task ? url('task/update', $task->id) : url('task/new') }}">
							{!! csrf_field() !!}
							
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" value="{{ $task ? $task->name : old('name') }}">
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
									<select class="form-control" name="project_id" value="{{ $task ? $task->project_id : old('project_id') }}">
										@foreach ($projects as $project)
											@if ($task && $task->project_id == $project->id)
												<option value="{{ $project->id }}" selected>{{ $project->name }}</option>
											@else
												<option value="{{ $project->id }}">{{ $project->name }}</option>
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
									<select class="form-control" name="task_status_id" value="{{ $task ? $task->task_status_id : old('task_status_id') }}">
										@foreach ($taskStatusList as $taskStatus)
											@if ($task && $task->task_status_id == $taskStatus->id)
												<option value="{{ $taskStatus->id }}" selected>{{ $taskStatus->name }}</option>
											@else
												<option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
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
									<input type="date" class="form-control" name="closed_at" value="{{ $task ? $task->closed_at : old('closed_at') }}">
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
									<textarea class="form-control" name="description" rows="10" cols="30">{{ $task ? $task->description : old('description') }}</textarea>
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
										<i class="fa fa-btn fa-save"></i>{{ $task ? 'Update' : 'Create' }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endif
	@if (count($tasks) > 0)
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Task List</div>
	
					<div class="panel-body">
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
								@foreach ($tasks as $task)
									<tr>
										<td class="table-text"><div>{{ $task->name }}</div></td>
										<td class="table-text"><div>{{ $projectOptions[$task->project_id] }}</div></td>
										<td class="table-text"><div>{{ $statusOptions[$task->task_status_id] }}</div></td>
										<td class="table-text"><div>{{ $task->closed_at }}</div></td>
										<td class="table-text"><div>{{ $task->description }}</div></td>
										<td class="button-in-line">
											@if (!Auth::guest())
												<a href="{{ url('task', $task->id) }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</a>
												<form action="/task/delete/{{ $task->id }}" method="POST">
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
		</div>
	@endif
</div>
@endsection
