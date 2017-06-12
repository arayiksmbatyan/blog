@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
			@include('layouts/alerts')
		    <h2>Add Post</h2>
			{{ Form::open(['url' => ['post'], 'method' => 'POST', 'files' => true]) }}
				<div class="col-sm-12 form-group">
					<div class="col-sm-6">
						<label class="control-label col-sm-12" for="title">Post Title:</label>
						<input type="text" id="title" class="col-sm-12 form-control" placeholder="Enter Name" name="title">
						@if ($errors->has('name'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('name') }}</strong>
			                </span>
			            @endif
					</div>

					<div class="col-sm-6">
						<label class="control-label col-sm-12" for="text">Post Text:</label>
						<textarea class="col-sm-12 form-control" id="text" name="text" placeholder="Enter Text"></textarea>
						@if ($errors->has('name'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('name') }}</strong>
			                </span>
			            @endif
					</div>
					<div class="col-sm-6">
						<label class="control-label col-sm-12" for="category">Post Category:</label>
						<select name="category" class="col-sm-12 form-control" id="category">
							@foreach ($categories as $category)	
								<option value="{{$category->id}}">{{$category->name}}</option>
							@endforeach	
						</select>
					</div>
					<div class="col-sm-6">
						<label class="control-label col-sm-12" for="text">Post image:</label>
						<input type="file" name="image">
					</div>
					<div class="col-sm-12 btn-cont">        
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary">Add</button>
						</div>
					</div>
				</div>
				
			{{ Form::close() }}
		</div>
	</div>
@endsection
