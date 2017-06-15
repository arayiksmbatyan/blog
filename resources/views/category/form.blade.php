@if(isset($category))
	{{ Form::model($category, array('method' => 'PUT','route' => array('categoryUpdate', $category->id))) }}
@else
{{ Form::open(['url' => ['category'], 'method' => 'POST']) }}
@endif
	<div class="form-group">
		{{Form::label('name', 'Category Name:', ['class' => 'control-label col-sm-4'])}}
		<div class="col-sm-4">
			{{Form::text('name', null, ['class' => 'form-control'])}}
			@if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
		</div>
	</div>
	<div class="form-group">        
		<div class="col-sm-4">
			@if(isset($category))
				{{Form::submit('Update', ['class' => 'btn btn-primary'])}}
			@else
				{{Form::submit('Create', ['class' => 'btn btn-primary'])}}
			@endif	
			
		</div>
	</div>
{{ Form::close() }}