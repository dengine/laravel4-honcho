@extends('honcho::layouts.common')

@section('content')

<div class="span9">

	<h1 class="page-title">Delete a Group</h1>

	{{-- Include our messages if there are any --}}
	{{ Messages::render('honcho::partials.messages.render', 'honcho::group.view') }}

	<div class="widget">
		<div class="widget-header">
			<h3><i class="icon-table"></i>&nbsp;&nbsp;{{ $group->name }} :: Confirm Delete</h3>
		</div>

		<div class="widget-content">
			<div class="alert alert-block alert-error">
				<h4>This Cannot Be Undone</h4>
				<p>
					Please confirm that you want to delete this group, this action cannot be undone.
				</p>
			</div>

			<div style="text-align:center;">
				<a href="{{ URL::route('honcho.group.confirmDelete', array($group->id)) }}" class="btn btn-danger btn-large">Yes, Delete the <strong>{{ strtoupper($group->name) }}</strong> Group.</a> &nbsp;&nbsp;
				<a href="{{ URL::route('honcho.group.view', array($group->id)) }}" class="btn btn-large">Cancel Delete</a>
			</div>
		</div>
	</div>
@stop