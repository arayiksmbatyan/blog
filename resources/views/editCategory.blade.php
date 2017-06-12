@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		@include('layouts/alerts')
		    <h2>Update Category</h2>				
			<div class="col-sm-offset-2 col-sm-10">
			{{ Form::open(['url' => ['category', $category->id], 'method' => 'put']) }}
				<div class="form-group">
					<div class="col-sm-4">
						<input type="text" id="name" class="form-control" placeholder="Enter Name" name="name" value="{{$category->name}}">
						@if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
					</div>
				</div>
				<button type="submit" class="btn btn-default">Update</button>
			{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection