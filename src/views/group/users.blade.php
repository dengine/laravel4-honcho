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
				Use the tool below to manage the groups that this user belongs to.
			</p>
		</div>
	</div>

	<div class="widget">
		<div class="widget-header">
			<h3>User information</h3>
		</div>

		<div class="widget-content">
			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'honcho::user.groups') }}

			<form method="post">

				<fieldset>
					<legend>Add User to Groups</legend>
					@include('honcho::partials.multiselect_users')
				</fieldset>

				<div class="row">
					<div class="pull-right">
						<button type="submit" href="#" class="btn btn-submit btn-large pull-right"><i class="icon-magic"></i>&nbsp;&nbsp; Update Groups</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Content -->


@stop