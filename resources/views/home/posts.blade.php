@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>{{$category}}</h2>
			@foreach ($posts as $post)
				<div class="col-sm-12">
					@if(empty($post->image))
						<img src="/images/default.png" class="col-sm-2">
					@else 
						<img src="/images/{{$post->image}}" class="col-sm-2">
					@endif	
					<p class="col-sm-4">{{$post->title}}</p>
					<p class="col-sm-4">{{$post->text}}</p>
				</div>
			@endforeach
		</div>
	</div>
@endsection