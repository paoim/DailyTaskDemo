@extends('layouts.app')

@section('title')
Project Status
@stop

@section('content')
<div class="container">
	@if (!Auth::guest())
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">{{ $projectStatus ? 'Update Project Status #' .$projectStatus->id : 'New Project Status' }}</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ $projectStatus ? url('projectStatus/update', $projectStatus->id) : url('projectStatus/new') }}">
							{!! csrf_field() !!}
							
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" value="{{ $projectStatus ?  $projectStatus->name : old('name') }}">
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
									<select class="form-control" name="active" value="{{ $projectStatus ?  $projectStatus->active : old('active') }}">
										@foreach ($options as $key => $value)
											@if ($projectStatus && $projectStatus->active == $key)
												<option value="{{ $key }}" selected>{{ $value }}</option>
											@elseif ($key == 1 && !$projectStatus)
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
							<div class="form-group{{ $errors->has('abv') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">ABV</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="abv" value="{{ $projectStatus ?  $projectStatus->abv : old('abv') }}">
									@if ($errors->has('abv'))
										<span class="help-block">
											<strong>{{ $errors->first('abv') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-btn fa-save"></i>{{ $projectStatus ? 'Update' : 'Create' }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endif
	@if (count($projectStatusList) > 0)
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Project Status List</div>
					<div class="panel-body">
						<table class="table table-striped task-table">
							<thead>
								<th>Name</th>
								<th>Active</th>
								<th>ABV</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($projectStatusList as $projectStatus)
									<tr>
										<td class="table-text"><div>{{ $projectStatus->name }}</div></td>
										<td class="table-text"><div>{{ $options[$projectStatus->active] }}</div></td>
										<td class="table-text"><div>{{ $projectStatus->abv }}</div></td>
										<td class="button-in-line">
											@if (!Auth::guest())
												<a href="{{ url('projectStatus', $projectStatus->id) }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</a>
												<form action="/projectStatus/delete/{{ $projectStatus->id }}" method="POST">
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
