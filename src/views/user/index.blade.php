@extends('honcho::layouts.common');

@section('content')

<div class="span9">

	<div class="widget widget-table">
		<div class="widget-header">
			<h3><i class="icon-table"></i>&nbsp;&nbsp; {{ Settings::getPageTitle() }}</h3>
		</div>

		<div class="widget-content">

			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'admin.user.create') }}

			<table class="table table-striped">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th class="table-actions"></th>
					</tr>
				</thead>
				<tbody>
					@if (count($users) > 0)
						@foreach ($users as $user)
							<tr>
								<td>{{ $user->first_name}}</td>
								<td>{{ $user->last_name }}</td>
								<td>{{ $user->email }}</td>
								<td class="table-actions">
									<div class="btn-group">
										<a class="btn" href="{{URL::route('honcho.user.view', array($user->id)) }}" ><i class="icon-dashboard"></i></a>
										<a class="btn" href="{{URL::route('honcho.user.update', array($user->id)) }}" ><i class="icon-pencil"></i></a>
										<a class="btn" href="{{URL::route('honcho.user.groups', array($user->id)) }}"><i class="icon-group"></i></a>
										<a class="btn" href="{{URL::route('honcho.user.permissions', array($user->id)) }}"><i class="icon-lock"></i></a>
									</div>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5">There are no users to display. <a href="{{URL::route('honcho.user.create') }}">Create New User</a></td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>

@stop