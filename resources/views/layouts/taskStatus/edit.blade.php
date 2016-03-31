@extends('layouts.app')

@section('title')
Edit Task Status
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Task Status #{{$TaskStatus->id}}</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('taskStatus/update', $TaskStatus->id) }}">
						{!! csrf_field() !!}
						
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $TaskStatus->name }}">
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
								<select class="form-control" name="active" value="{{ $TaskStatus->active }}">
									@foreach ($options as $key => $value)
										@if ($key == $TaskStatus->active)
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
									<i class="fa fa-btn fa-save"></i>Update
								</button>
								<a href="{{ url('taskStatus/detail', $TaskStatus->id) }}" class="btn btn-primary">
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
