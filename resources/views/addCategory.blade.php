@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
			@include('layouts/alerts')
		    <h2>Add Category</h2>
			{{ Form::open(['url' => ['category'], 'method' => 'POST']) }}
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Category Name:</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" placeholder="Enter Name" name="name">
						@if ($errors->has('name'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('name') }}</strong>
			                </span>
			            @endif
					</div>
				</div>
				<div class="form-group">        
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Add New Category</button>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection

