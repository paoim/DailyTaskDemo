@extends('layouts.app')

@section('title')
Task Status Detail
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Task Status Detail #{{$TaskStatus->id}}</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-md-3">Name</div>
						<div class="col-md-7">{{ $TaskStatus->name }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">Status</div>
						<div class="col-md-7">{{ $options[$TaskStatus->active] }}</div>
					</div>
					@if (!Auth::guest())
						<div class="form-group">
							<div class="col-md-9 col-md-offset-1 button-in-line">
								<a href="{{ url('taskStatus/edit', $TaskStatus->id) }}" class="btn btn-primary">
									<i class="fa fa-btn fa-pencil"></i>Edit
								</a>
								<form action="/taskStatus/delete/{{ $TaskStatus->id }}" method="POST">
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
