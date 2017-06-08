@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>All Posts</h2>
			@foreach ($posts as $post)
				<div class="col-sm-12">
					<p class="col-sm-4">{{$post->title}}</p>
					<p class="col-sm-4">{{$post->text}}</p>
					@if(Auth::user()->id == $post->category->user_id)
						<a href="/post/{{$post->id}}/edit" class="btn btn-primary col-sm-2">Edit</a>
						{{ Form::open(['url' => ['post', $post->id], 'method' => 'delete']) }}
							<button type="submit" class="btn btn-primary col-sm-2">Delete</button>
						{{ Form::close() }}
					@endif
				</div>
			@endforeach
		</div>
	</div>
@endsection