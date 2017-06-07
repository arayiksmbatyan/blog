@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		    <h2>Add Category</h2>
			<form class="form-horizontal" method="POST" action="/category">
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Category Name:</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" placeholder="Enter Name" name="categoryName">
					</div>
				</div>
				<div class="form-group">        
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="addCategory" class="btn btn-default">Add New Category</button>
					</div>
				</div>
				{{csrf_field()}}
			</form>
		</div>
	</div>
@endsection
