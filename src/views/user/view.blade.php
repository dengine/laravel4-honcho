@extends('honcho::layouts.common')

@section('content')

<div class="span9">

	<div class="widget widget-table">
		<div class="widget-header">
			<h3><i class="icon-table"></i>&nbsp;&nbsp;{{ Settings::getPageTitle() }}</h3>

			<div class="widget-tools">
				<a class="btn btn-mini" href="{{ URL::route("honcho.user.update", array($user->id)) }}">
					<i class="icon-pencil"></i>&nbsp; Update Information
				</a>
			</div>
		</div>

		<div class="widget-content">
			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'honcho::user.view') }}

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email Address</th>
						<th>Username</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td>{{ $user->first_name }}</td>
						<td>{{ $user->last_name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->username }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="widget widget-table">
		<div class="widget-header">
			<h3><i class="icon-group"></i>&nbsp;&nbsp;Groups</h3>

			<div class="widget-tools">
				<a class="btn btn-mini" href="{{ URL::route("honcho.user.groups", array($user->id)) }}">
					<i class="icon-pencil"></i>&nbsp; Update Group Membership(s)
				</a>
			</div>
		</div>

		<div class="widget-content">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Group Name</th>
					</tr>
				</thead>

				<tbody>
					@if (count($groups) >= 1)
						@foreach ($groups as $group)
							<tr>
								<td>{{ $group->name }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td>This user does not belong to any groups</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

@stop