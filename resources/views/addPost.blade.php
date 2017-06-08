@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
			@include('layouts/alerts')
		    <h2>Add Post</h2>
			{{ Form::open(['url' => ['post'], 'method' => 'POST']) }}
				<div class="col-sm-12 form-group">
					<div class="col-sm-4">
						<label class="control-label col-sm-6" for="email">Post Title:</label>
						<input type="text" class="col-sm-6 form-control" placeholder="Enter Name" name="title">
						@if ($errors->has('name'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('name') }}</strong>
			                </span>
			            @endif
					</div>

					<div class="col-sm-4">
						<label class="control-label col-sm-6" for="text">Post Text:</label>
						<textarea class="col-sm-6 form-control" id="text" name="text" placeholder="Enter Text"></textarea>
						@if ($errors->has('name'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('name') }}</strong>
			                </span>
			            @endif
					</div>
					<div class="col-sm-4">
						<label class="control-label col-sm-4" for="category">Post Category:</label>
						<select name="category" class="col-sm-8 form-control" id="category">
							@foreach ($categories as $category)	
								<option value="{{$category->id}}">{{$category->name}}</option>
							@endforeach	
						</select>
					</div>
					<div class="col-sm-4 form-group">        
						<div class="col-sm-12">
							<button type="submit" class="btn btn-default">Add</button>
						</div>
					</div>
				</div>
				
			{{ Form::close() }}
		</div>
	</div>
@endsection