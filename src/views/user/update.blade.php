@extends('honcho::layouts.common');

@section('content')

<!-- Content -->
<div class="span9">
	<div class="widget">
		<div class="widget-header">
			<h3>{{ Settings::getPageTitle() }}</h3>
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

					<div class="control-group span4 @if ($errors->has('username')) error @endif">
						<label>Username</label>
						<input type="text" name="username" value="{{ Input::old('username', $user->username) }}" class="span4" required>

						@if ($errors->has('username'))
							<span class="help-block">{{ $errors->first('username') }}</span>
						@endif
					</div>

					<div class="control-group span4 @if ($errors->has('email')) error @endif">
						<label>Email Address</label>
						<input type="text" name="email" value="{{ Input::old('email', $user->email) }}" class="span4" required>

						@if ($errors->has('email'))
							<span class="help-block">{{ $errors->first('email') }}</span>
						@endif
					</div>

					<div class="control-group span4 @if ($errors->has('first_name')) error @endif">
						<label>First Name</label>
						<input type="text" name="first_name" value="{{ Input::old('first_name', $user->first_name) }}" class="span4" required>

						@if ($errors->has('first_name'))
							<span class="help-block">{{ $errors->first('first_name') }}</span>
						@endif
					</div>

					<div class="control-group span4 @if ($errors->has('last_name')) error @endif">
						<label>Last Name</label>
						<input type="text" name="last_name" value="{{ Input::old('last_name', $user->last_name) }}" class="span4" required>

						@if ($errors->has('last_name'))
							<span class="help-block">{{ $errors->first('last_name') }}</span>
						@endif
					</div>

					<div class="pull-right form-action-block">
						<button type="submit" class="btn btn-submit btn-large"><i class="icon-ok-sign"></i> Save changes</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
<!-- /Content -->


@stop