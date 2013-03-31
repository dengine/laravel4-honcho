@extends('honcho::layouts.common');

@section('content')

<!-- Content -->
<div class="span9">
	<div class="widget">
		<div class="widget-header">
			<h3>Create a New User</h3>
		</div>

		<div class="widget-content">
			<p>
				Use the tool below to create a new user. Once the account has been created, the user will be able to sign into their account.
			</p>

			<p>
				<small>All fields are required to complete the registration.</small>
			</p>
		</div>
	</div>

	<div class="widget">
		<div class="widget-header">
			<h3>User information</h3>
		</div>

		<div class="widget-content">
			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'honcho::user.create') }}

			<form method="post">
				<div class="row">
					<div class="control-group span4 @if ($errors->has('username')) error @endif">
						<label>Username</label>
						<input type="text" name="username" value="{{ Input::old('username') }}" class="span4" required>

						@if ($errors->has('username'))
							<span class="help-block">{{ $errors->first('username') }}</span>
						@endif
					</div>

					<div class="control-group span4 @if ($errors->has('email')) error @endif">
						<label>Email Address</label>
						<input type="text" name="email" value="{{ Input::old('email') }}" class="span4" required>

						@if ($errors->has('email'))
							<span class="help-block">{{ $errors->first('email') }}</span>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="control-group span4 @if ($errors->has('first_name')) error @endif">
						<label>First Name</label>
						<input type="text" name="first_name" value="{{ Input::old('first_name') }}" class="span4" required>

						@if ($errors->has('first_name'))
							<span class="help-block">{{ $errors->first('first_name') }}</span>
						@endif
					</div>

					<div class="control-group span4 @if ($errors->has('last_name')) error @endif">
						<label>Last Name</label>
						<input type="text" name="last_name" value="{{ Input::old('last_name') }}" class="span4" required>

						@if ($errors->has('last_name'))
							<span class="help-block">{{ $errors->first('last_name') }}</span>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="control-group span4 @if ($errors->has('password')) error @endif">
						<label>Password</label>
						<input type="password" name="password" class="span4" required>

						@if ($errors->has('password'))
							<span class="help-block">{{ $errors->first('password') }}</span>
						@endif
					</div>

					<div class="control-group span4 @if ($errors->has('password_confirmation')) error @endif">
						<label>Retype Password</label>
						<input type="password" name="password_confirmation" class="span4" required>

						@if ($errors->has('password_confirmation'))
							<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
						@endif
					</div>
				</div>

				<fieldset>
					<legend>Add User to Groups</legend>
					@include('honcho::partials.multiselect_groups')
				</fieldset>

				<div class="row">
					<div class="pull-right">
						<button type="submit" href="#" class="btn btn-submit btn-large"><i class="icon-magic"></i>&nbsp; Create New User</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Content -->


@stop