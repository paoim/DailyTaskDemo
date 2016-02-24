@extends('layouts.app')

@section('title')
Project
@stop

@section('content')
<div class="container">
	@if (!Auth::guest())
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">{{ $project ? 'Update Project #' .$project->id : 'New Project' }}</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ $project ? url('update', $project->id) : url('new') }}">
							{!! csrf_field() !!}
							
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" value="{{ $project ? $project->name : old('name') }}">
									@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('project_status_id') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Status</label>
								<div class="col-md-6">
									<select class="form-control" name="project_status_id" value="{{ $project ? $project->project_status_id : old('project_status_id') }}">
										@foreach ($projectStatusList as $projectStatus)
											@if ($project && $project->project_status_id == $projectStatus->id)
												<option value="{{ $projectStatus->id }}" selected>{{ $projectStatus->name }}</option>
											@else
												<option value="{{ $projectStatus->id }}">{{ $projectStatus->name }}</option>
											@endif
										@endforeach
									</select>
									@if ($errors->has('project_status_id'))
										<span class="help-block">
											<strong>{{ $errors->first('project_status_id') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('started_at') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Start Date</label>
								<div class="col-md-6">
									<input type="date" class="form-control" name="started_at" value="{{ $project ? $project->started_at : old('started_at') }}">
									@if ($errors->has('started_at'))
										<span class="help-block">
											<strong>{{ $errors->first('started_at') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('ended_at') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">End Date</label>
								<div class="col-md-6">
									<input type="date" class="form-control" name="ended_at" value="{{ $project ? $project->ended_at : old('ended_at') }}">
									@if ($errors->has('ended_at'))
										<span class="help-block">
											<strong>{{ $errors->first('ended_at') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('closed_at') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Closed Date</label>
								<div class="col-md-6">
									<input type="date" class="form-control" name="closed_at" value="{{ $project ? $project->closed_at : old('closed_at') }}">
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
									<textarea class="form-control" name="description" rows="10" cols="30">{{ $project ? $project->description : old('description') }}</textarea>
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
										<i class="fa fa-btn fa-save"></i>{{ $project ? 'Update' : 'Create' }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endif
	@if (count($projects) > 0)
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Project List</div>
	
					<div class="panel-body">
						<table class="table table-striped task-table">
							<thead>
								<th>Name</th>
								<th>Status</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Close Date</th>
								<th>Description</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($projects as $project)
									<tr>
										<td class="table-text"><div>{{ $project->name }}</div></td>
										<td class="table-text"><div>{{ $statusOptions[$project->project_status_id] }}</div></td>
										<td class="table-text"><div>{{ $project->started_at }}</div></td>
										<td class="table-text"><div>{{ $project->ended_at }}</div></td>
										<td class="table-text"><div>{{ $project->closed_at }}</div></td>
										<td class="table-text"><div>{{ $project->description }}</div></td>
										<td class="button-in-line">
											@if (!Auth::guest())
												<a href="{{ url('detail', $project->id) }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</a>
												<form action="/delete/{{ $project->id }}" method="POST">
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
