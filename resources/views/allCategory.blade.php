@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>All Categories</h2>
		    @if (isset($categories)) 
				@foreach ($categories as $category)		
					@if($category->user_id == Auth::user()->id)
					<div class="col-sm-12">
						<a href="#" class="col-sm-8">{{$category->name}}</a>
						<a href="/category/{{$category->id}}/edit" class="btn btn-primary col-sm-2">Edit</a>
						{{ Form::open(['url' => ['category', $category->id], 'method' => 'delete']) }}
							<button type="submit" class="btn btn-primary col-sm-2">Delete</button>
						{{ Form::close() }}
					</div> 
					@else
					<div class="col-sm-12">
						<a href="#" class="col-sm-8">{{$category->name}}</a>
					</div>
					@endif
				@endforeach
			@else 
			<p>No Category</p>	
			@endif
		</div>
	</div>
@endsection