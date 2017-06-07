@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>Update Category</h2>

			<form class="form-horizontal" method="POST" action="/category">
				<input type="hidden" name="_method" value="PUT">
				<div class="form-group">
					
					<div class="col-sm-4">
						<input type="text" id="name" class="form-control" placeholder="Enter Name" name="updateCategoryName">
					</div>
				</div>
				<div class="form-group">        
					<div class="col-sm-offset-2 col-sm-10">
					{{ Form::open(['url' => ['categories', $categories->id], 'method' => 'put']) }}
						<button type="submit" name="updateCategory" class="btn btn-default">Update Category</button>
					{{ Form::close() }}
						
					</div>
				</div>
				{{csrf_field()}}
			</form>
		</div>
	</div>
@endsection