@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		@include('layouts/alerts')
		    <h2>Update Post</h2>				
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::open(['url' => ['post', $post->id], 'method' => 'put', 'files' => true]) }}
					<div class="form-group">
						<div class="col-sm-6">
							<label class="control-label col-sm-12" for="email">Post Title:</label>
							<input type="text" class="col-sm-12 form-control" placeholder="Enter Name" name="title" value="{{$post->title}}">
							@if ($errors->has('name'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('name') }}</strong>
				                </span>
				            @endif
						</div>
						<div class="col-sm-6">
							<label class="control-label col-sm-12" for="text">Post Text:</label>
							<textarea class="col-sm-12 form-control" id="text" name="text" placeholder="Enter Text">{{$post->text}}</textarea>
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
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection