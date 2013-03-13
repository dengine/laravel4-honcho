@extends('user::layouts.auth')

@section('content')

<div class="row">
	<!-- Login content -->
	<div id="create-account">
		<div id="main-header">
			<h3>Create a New Account</h3>
		</div>

		<div id="login-content" class="clearfix">
			@include('notifications')

			<form action="" method="post" action="">
				<fieldset>
					<div class="control-group @if ($errors->has('first_name')) error @endif">
						<label class="control-label" for="first_name"><i class="icon-user"></i>&nbsp;&nbsp; First Name</label>
						<input type="text" id="first_name" name="first_name" value="{{ Input::old('first_name') }}" required>

						@if ($errors->has('first_name'))
						<p class="help-block">{{ $errors->first('first_name') }}</p>
						@endif
					</div>

					<div class="control-group @if ($errors->has('last_name')) error @endif">
						<label class="control-label" for="last_name"><i class="icon-user"></i>&nbsp;&nbsp; Last Name</label>
						<input type="text" id="last_name" name="last_name" value="{{ Input::old('last_name') }}" required>

						@if ($errors->has('last_name'))
						<p class="help-block">{{ $errors->first('last_name') }}</p>
						@endif
					</div>

					<div class="control-group @if ($errors->has('email')) error @endif">
						<label class="control-label" for="email"><i class="icon-envelope"></i>&nbsp;&nbsp; Email</label>
						<input type="email" id="email" name="email" value="{{ Input::old('email') }}" required>

						@if ($errors->has('email'))
						<p class="help-block">{{ $errors->first('email') }}</p>
						@endif
					</div>


					<div class="control-group @if ($errors->has('password')) error @endif">
						<label class="control-label" for="password"><i class="icon-lock"></i>&nbsp;&nbsp;Password</label>
						<input type="password" id="password" name="password" required>

						@if ($errors->has('password'))
						<p class="help-block">{{ $errors->first('password') }}</p>
						@endif
					</div>

					<div class="control-group @if ($errors->has('password_confirmation')) error @endif">
						<label class="control-label" for="password_confirmation"><i class="icon-lock"></i>&nbsp;&nbsp;Retype Password</label>
						<input type="password" id="password_confirmation" name="password_confirmation" value="{{ Input::old('') }}" required>

						@if ($errors->has('password_confirmation'))
						<p class="help-block">{{ $errors->first('password_confirmation') }}</p>
						@endif
					</div>

					<div>
						<p class="pull-left"><a href="{{ URL::route('auth.forgotpassword') }}"><i class="icon-key"></i>&nbsp;Forgot Your Password?</a></p>
						<p class="pull-right">Don't have an account yet?&nbsp;&nbsp;<a href="{{ URL::route('auth.register') }}">Sign Up</a></p>
					</div>
				</fieldset>
				<hr>
				<div class="pull-right">
					<button type="submit" class="btn btn-success btn-large"><i class="icon-magic"></i>&nbsp;&nbsp;Login</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- /Login content -->
</div>

@stop