@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>My Categories</h2>
			@foreach ($categories as $category)
				@if($category->user_id == Auth::user()->id)
				<div class="col-sm-12">
					<a href="#" class="col-sm-8">{{$category->name}}</a>
					<button class="col-sm-2">Edit</button>
					<button class="col-sm-2">Delete</button>
				</div>
				@endif
			@endforeach
		</div>
	</div>
@endsection
