@extends('layouts.app')

@section('title')
Edit Project Status
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Project Status #{{$ProjectStatus->id}}</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('projectStatus/update', $ProjectStatus->id) }}">
						{!! csrf_field() !!}
						
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $ProjectStatus->name }}">
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
								<select class="form-control" name="active" value="{{ $ProjectStatus->active }}">
									@foreach ($options as $key => $value)
										@if ($key == $ProjectStatus->active)
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
								<input type="text" class="form-control" name="abv" value="{{ $ProjectStatus->abv }}">
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
									<i class="fa fa-btn fa-save"></i>Update
								</button>
								<a href="{{ url('projectStatus/detail', $ProjectStatus->id) }}" class="btn btn-primary">
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
