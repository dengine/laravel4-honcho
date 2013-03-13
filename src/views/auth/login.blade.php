@extends('honcho::layouts.auth')

@section('content')
<div class="row">
	<!-- Login content -->
 	<div id="login">
 		<div id="main-header">
 			<h3>Login to Your Account</h3>
 		</div>

 		<div id="login-content" class="clearfix">
 			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'honcho::auth.login') }}

 			<form action="login" method="post" action="">
 				<fieldset>
 					<div class="control-group @if ($errors->has('login_column')) error @endif">
 						<label class="control-label" for="login_column"><i class="icon-user"></i>&nbsp;&nbsp;{{ ucwords(Config::get('cartalyst/sentry::sentry.users.login_attribute')) }}</label>
 						<input type="text" id="login_column" name="login_column">

 						@if ($errors->has('login_column'))
 							<p class="help-block">Your {{ Config::get('cartalyst/sentry::sentry.users.login_attribute') }} is required.</p>
 						@endif
 					</div>


 					<div class="control-group @if ($errors->has('password')) error @endif">
 						<label class="control-label" for="password"><i class="icon-lock"></i>&nbsp;&nbsp;Password</label>
 						<input type="password" id="password" name="password">

 						@if ($errors->has('password'))
 							<p class="help-block">{{ $errors->first('password') }}</p>
 						@endif

 						<p class="pull-left"><a href="{{ URL::route('forgotpassword') }}"><i class="icon-key"></i>&nbsp;Forgot Your Password?</a></p>
 					</div>
 				</fieldset>
 				<hr>
 				<div class="pull-right">
 					<button type="submit" class="btn btn-success btn-large"><i class="icon-magic"></i>&nbsp;&nbsp;Login</button>
 				</div>
 			</form>
 		</div>
 	</div>
	<!-- /Login content -->
</div>

@stop