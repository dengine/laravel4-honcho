@extends('honcho::layouts.common');

@section('content')

<!-- Content -->
<div class="span9">
	<h1 class="page-title">Create a New Group</h1>

	<div class="widget">
		<div class="widget-header">
			<h3>Create a New Group</h3>
		</div>

		<div class="widget-content">
			<p>
				Use the tool below to create a new group.
			</p>
		</div>
	</div>

	<div class="widget">
		<div class="widget-header">
			<h3>Group Information</h3>
		</div>

		<div class="widget-content">
			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'honcho::group.create') }}

			<form method="post">
				<div class="row">
					<div class="control-group span4 @if ($errors->has('name')) error @endif">
						<label>Name</label>
						<input type="text" name="name" value="{{ Input::old('name') }}" class="span4" required>

						@if ($errors->has('name'))
							<span class="help-block">{{ $errors->first('name') }}</span>
						@endif
					</div>
				</div>

				<fieldset>
					<legend>Add Users to the Group</legend>
					@include('honcho::partials.multiselect_users')
				</fieldset>

				<div class="row">
					<div class="pull-right">
						<button type="submit" href="#" class="btn btn-submit btn-large"><i class="icon-magic"></i>&nbsp; Create New Group</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Content -->


@stop