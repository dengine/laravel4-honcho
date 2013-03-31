<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Honcho Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- CSS files -->
    <link href="/packages/dberry37388/honcho/css/bootstrap.min.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/alveolae.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/bootstrap-duallistbox.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/custom.css" rel="stylesheet">

    <!-- Google font -->
    <link href='http://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
	<!-- Navbar -->
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="index.html">{{ Settings::getSiteName() }}</a>
				<div class="nav-collapse">
					<ul class="nav pull-right">
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-cloud"></i>&nbsp;&nbsp;User &nbsp;<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href=""><i class="icon-file"></i>&nbsp;&nbsp;Update Profile</a></li>
								<li><a href=""><i class="icon-key"></i>&nbsp;&nbsp;Change Password</a></li>
							</ul>
						</li>
						<li class="divider-vertical"></li>
						<li><a href=""><i class="icon-lock"></i>&nbsp;&nbsp;Logout</a></li>
						<li class="divider-vertical"></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /Navbar -->

	<!-- Main content -->
	<div id="main-content">
		<!-- Container -->
		<div class="container">
			<div class="row">
				<!-- Sidebar -->
				<div class="span3">
					<ul id="sidebar" class="nav nav-tabs nav-stacked">
						<li class="accordion  {{ Settings::isUri('admin/user*', 'active') }}" id="navigation-components">
							<a href="#collapse-menu-users" class="accordion-toggle in" data-toggle="collapse" data-parent="navigation-components">
								<i class="icon-dashboard"></i>&nbsp;&nbsp;Manage Users
							</a>

							<div id="collapse-menu-users" class="accordion-body collapse  {{ Settings::isUri('admin/user*', 'in') }}">
								<div class="sidebar-extra well">
									<ul class="nav nav-list">
										@if (Settings::isNavSection('user'))
											<li class="nav-header">{{ $user->username }} Tools:</li>
											<li><a href="{{ URL::route('honcho.user.view', array($user->id)) }}"><i class="icon-eye-open"></i> View Details</a></li>
											<li><a href="{{ URL::route('honcho.user.update', array($user->id)) }}"><i class="icon-pencil"></i> Update Details</a></li>
											<li><a href="{{ URL::route('honcho.user.users', array($user->id)) }}"><i class="icon-user"></i> Add/Remove Users</a></li>
											<li><a href="{{ URL::route('honcho.user.delete', array($user->id)) }}"><i class="icon-remove-sign"></i> Delete Group</a></li>
											<li class="divider"></li>
										@endif
										<li><a href="{{ URL::route('honcho.user') }}"><i class="icon-home"></i> Manage Users</a></li>
										<li><a href="{{ URL::route('honcho.user.create') }}"><i class="icon-plus-sign"></i> Create New User</a></li>
									</ul>
								</div>
							</div>
						</li>

						<li class="accordion  {{ Settings::isUri('admin/group*', 'active') }}" id="navigation-components">
							<a href="#collapse-menu-groups" class="accordion-toggle in" data-toggle="collapse" data-parent="navigation-components">
								<i class="icon-dashboard"></i>&nbsp;&nbsp;Manage Groups
							</a>

							<div id="collapse-menu-groups" class="accordion-body collapse  {{ Settings::isUri('admin/group*', 'in') }}">
								<div class="sidebar-extra well">
									<ul class="nav nav-list">
										@if (Settings::isNavSection('group'))
											<li class="nav-header">{{ $group->name }} Tools:</li>
											<li><a href="{{ URL::route('honcho.group.view', array($group->id)) }}"><i class="icon-eye-open"></i> View Details</a></li>
											<li><a href="{{ URL::route('honcho.group.update', array($group->id)) }}"><i class="icon-pencil"></i> Update Details</a></li>
											<li><a href="{{ URL::route('honcho.group.users', array($group->id)) }}"><i class="icon-user"></i> Add/Remove Users</a></li>
											<li><a href="{{ URL::route('honcho.group.delete', array($group->id)) }}"><i class="icon-remove-sign"></i> Delete Group</a></li>
											<li class="divider"></li>
										@endif
										<li class="nav-header">Group Manager</li>
										<li><a href="{{ URL::route('honcho.group') }}"><i class="icon-home"></i> Manage Groups</a></li>
										<li><a href="{{ URL::route('honcho.group.create') }}"><i class="icon-plus-sign"></i> Create New Group</a></li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<!-- /Sidebar -->

				<!-- Content -->
				@yield('content')
				<!-- /Content -->
			</div>

			<!-- Footer -->
			<div id="footer">
				<hr>
				<p class="pull-right">{{ Settings::getCopyright() }}</p>
			</div>
			<!-- /Footer -->

		</div>
		<!-- /Container -->
	</div>
	<!-- /Main content -->

	<!-- Javascript files -->
	<script type="text/javascript" src="/packages/dberry37388/honcho/js/jquery.min.js"></script>
	<script src="/packages/dberry37388/honcho/js/bootstrap.js"></script>
	<script src="/packages/dberry37388/honcho/js/bootstrap-duallistbox.js"></script>
	<script src="/packages/dberry37388/honcho/js/bootstrap-switch.js"></script>
	<script src="/packages/dberry37388/honcho/js/user.js"></script>

	@yield('javascripts')

</body>
</html>
