<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Username</th>
			<th class="table-actions">Actions</th>
		</tr>
	</thead>

	<tbody>
		@if (isset($users) and count($users) >= 1)
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->first_name }}</td>
					<td>{{ $user->last_name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->username }}</td>
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
				<td colspan="5">There are no users to display</td>
			</tr>
		@endif
	</tbody>
</table>