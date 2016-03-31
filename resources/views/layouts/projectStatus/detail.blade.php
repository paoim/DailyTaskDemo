@extends('layouts.app')

@section('title')
Task Project Detail
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Task Project Detail #{{$ProjectStatus->id}}</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-md-3">Name</div>
						<div class="col-md-7">{{ $ProjectStatus->name }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">Status</div>
						<div class="col-md-7">{{ $options[$ProjectStatus->active] }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">ABV</div>
						<div class="col-md-7">{{ $ProjectStatus->abv }}</div>
					</div>
					@if (!Auth::guest())
						<div class="form-group">
							<div class="col-md-9 col-md-offset-1 button-in-line">
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
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
