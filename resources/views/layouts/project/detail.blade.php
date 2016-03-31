@extends('layouts.app')

@section('title')
Project Detail
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Project Detail #{{ $Project->id}}</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-md-3">Name</div>
						<div class="col-md-7">{{ $Project->name }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">Status</div>
						<div class="col-md-7">{{ $statusOptions[$Project->project_status_id] }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">Start Date</div>
						<div class="col-md-7">{{ $Project->started_at }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">End Date</div>
						<div class="col-md-7">{{ $Project->ended_at }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">Closed Date</div>
						<div class="col-md-7">{{ $Project->closed_at }}</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">Description</div>
						<div class="col-md-7">{{ $Project->description }}</div>
					</div>
					@if (!Auth::guest())
						<div class="form-group">
							<div class="col-md-9 col-md-offset-1 button-in-line">
								<a href="{{ url('edit', $Project->id) }}" class="btn btn-primary">
									<i class="fa fa-btn fa-pencil"></i>Edit
								</a>
								<form action="/delete/{{ $Project->id }}" method="POST">
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
