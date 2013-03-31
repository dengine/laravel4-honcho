@extends('honcho::layouts.common');

@section('content')

<div class="span9">

	<div class="widget widget-table">
		<div class="widget-header">
			<h3><i class="icon-table"></i>&nbsp;&nbsp;Manage Groups</h3>
		</div>

		<div class="widget-content">

			{{-- Include our messages if there are any --}}
			{{ Messages::render('honcho::partials.messages.render', 'honcho::group.index') }}

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Group Name</th>
						<th class="table-actions"></th>
					</tr>
				</thead>
				<tbody>
					@if (count($groups) > 0)
						@foreach ($groups as $group)
							<tr>
								<td>{{ $group->name}}</td>
								<td class="table-actions">
									<div class="btn-group">
										<a class="btn" href="{{URL::route('honcho.group.view', array($group->id)) }}" ><i class="icon-dashboard"></i></a>
										<a class="btn" href="{{URL::route('honcho.group.update', array($group->id)) }}" ><i class="icon-pencil"></i></a>
										<a class="btn" href="{{URL::route('honcho.group.users', array($group->id)) }}"><i class="icon-group"></i></a>
										<a class="btn" href="{{URL::route('honcho.group.permissions', array($group->id)) }}"><i class="icon-key"></i></a>
										<a class="btn btn-danger" href="{{URL::route('honcho.group.delete', array($group->id)) }}"><i class="icon-remove-sign"></i></a>
									</div>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5">There are no groups to display. <a href="{{URL::route('honcho.group.create') }}">Create New Group</a></td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>

@stop