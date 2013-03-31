@extends('honcho::layouts.common')

@section('content')

<div class="span9">

	<h1 class="page-title">View Group Details</h1>

	<div class="widget widget-table">
		<div class="widget-header">
			<h3><i class="icon-table"></i>&nbsp;&nbsp;{{ $group->name }} Details</h3>

			<div class="widget-tools">
				<a class="btn btn-mini" href="{{ URL::route("honcho.group.update", array($group->id)) }}">
					<i class="icon-pencil"></i>&nbsp; Update Information
				</a>
			</div>
		</div>

		<div class="widget-content">
			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'honcho::group.view') }}

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Group Name</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>{{ $group->name }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="widget widget-table">
		<div class="widget-header">
			<h3><i class="icon-group"></i>&nbsp;&nbsp;Users in Group</h3>

			<div class="widget-tools">
				<a class="btn btn-mini" href="{{ URL::route("honcho.group.users", array($group->id)) }}">
					<i class="icon-pencil"></i>&nbsp; Update Users in Group
				</a>
			</div>
		</div>

		<div class="widget-content">
			@include('honcho::partials.table_users')
		</div>
	</div>

@stop