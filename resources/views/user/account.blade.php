@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row col-md-8 col-md-offset-2"> 
		@include('popups.alerts')
		    <h2>Update Password</h2>				
			<div class="col-sm-offset-2 col-sm-10">
			{{ Form::open(['url' => ['user', $user], 'method' => 'put']) }}
				<div class="form-group">
				    <label for="old-password" class="col-md-4 control-label">Old Password</label>

				    <div class="col-md-6">
				        <input id="old-password" type="password" class="form-control" name="old-password" required>
				    </div>
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				    <label for="password" class="col-md-4 control-label">Password</label>

				    <div class="col-md-6">
				        <input id="password" type="password" class="form-control" name="password" required>

				        @if ($errors->has('password'))
				            <span class="help-block">
				                <strong>{{ $errors->first('password') }}</strong>
				            </span>
				        @endif
				    </div>
				</div>

				<div class="form-group">
				    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

				    <div class="col-md-6">
				        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
				    </div>
				</div>
				<button type="submit" class="btn btn-default">Update</button>
			{{ Form::close() }}
				
			</div>
		</div>
	</div>
@endsection
