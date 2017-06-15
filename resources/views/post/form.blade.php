@if(isset($post))
	{{ Form::model($post, array('method' => 'PUT','route' => array('postUpdate', $post->id), 'files' => true)) }}
@else 
	{{ Form::open(['url' => ['post'], 'method' => 'POST', 'files' => true]) }}
@endif
	<div class="col-sm-12 form-group">
		<div class="col-sm-6">
			{{Form::label('title', 'Post Title:', ['class' => 'control-label col-sm-12'])}}
			{{Form::text('title', null, ['class' => 'col-sm-12 form-control'])}}

			@if ($errors->has('name'))
	            <span class="help-block">
	                <strong>{{ $errors->first('name') }}</strong>
	            </span>
	        @endif
		</div>

		<div class="col-sm-6">
			{{Form::label('text', 'Post Text:', ['class' => 'control-label col-sm-12'])}}
			{{Form::textarea('text', null, ['class' => 'col-sm-12 form-control', 'rows' => 2])}}

			@if ($errors->has('name'))
	            <span class="help-block">
	                <strong>{{ $errors->first('name') }}</strong>
	            </span>
	        @endif
		</div>
		<div class="col-sm-6">
			{{Form::label('category', 'Post Category:', ['class' => 'control-label col-sm-12'])}}
			<select name="category_id" class="col-sm-12 form-control" id="category">
				@foreach ($categories as $category)	
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach	
			</select>
		</div>
		<div class="col-sm-6">
			{{Form::label('file', 'Post image:', ['class' => 'control-label col-sm-12'])}}
			{{Form::file('image')}}
		</div>
		<div class="col-sm-12 btn-cont">        
			<div class="col-sm-12">
				@if(isset($post))
					{{Form::submit('Update', ['class' => 'btn btn-primary'])}}
				@else
					{{Form::submit('Create', ['class' => 'btn btn-primary'])}}
				@endif	
			</div>
		</div>
	</div>

{{ Form::close() }}