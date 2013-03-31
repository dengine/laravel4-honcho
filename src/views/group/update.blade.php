@extends('honcho::layouts.common');

@section('content')

<!-- Content -->
<div class="span9">
	<div class="widget">
		<div class="widget-header">
			<h3>Update Group</h3>
		</div>

		<div class="widget-content">
			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'honcho::group.create') }}

			<form method="post">
				<div class="row">
					<div class="control-group span4 @if ($errors->has('name')) error @endif">
						<label>Name</label>
						<input type="text" name="name" value="{{ Input::old('name', $group->name) }}" class="span4" required>

						@if ($errors->has('name'))
							<span class="help-block">{{ $errors->first('name') }}</span>
						@endif
					</div>
				</div>

				<div class="row">
					<div class="pull-right">
						<button type="submit" href="#" class="btn btn-submit btn-large">Save</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Content -->


@stop