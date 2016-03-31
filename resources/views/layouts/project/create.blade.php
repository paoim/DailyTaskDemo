@extends('layouts.app')

@section('title')
Create New Project
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Create New Project</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('store') }}">
						{!! csrf_field() !!}
						
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
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
								<select class="form-control" name="project_status_id" value="{{ old('project_status_id') }}">
									@foreach ($ProjectStatusList as $ProjectStatus)
										<option value="{{ $ProjectStatus->id }}">{{ $ProjectStatus->name }}</option>
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
								<input type="date" class="form-control" name="started_at" value="{{ date('Y-m-d') }}">
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
								<input type="date" class="form-control" name="ended_at" value="{{ date('Y-m-d') }}">
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
								<input type="date" class="form-control" name="closed_at" value="{{ date('Y-m-d') }}">
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
								<textarea class="form-control" name="description" rows="10" cols="30">{{ old('description') }}</textarea>
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
									<i class="fa fa-btn fa-save"></i>Create
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
