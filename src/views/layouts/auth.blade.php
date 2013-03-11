<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>{{ Settings::getTitle() }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- CSS files -->
    <link href="/packages/dberry37388/honcho/css/bootstrap.min.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/alveolae.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/custom.css" rel="stylesheet">
    <link href="/packages/dberry37388/honcho/css/font-awesome/css/font-awesome.css" rel="stylesheet">

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
			</div>
		</div>
	</div>

	<!-- /Navbar -->
	@yield('content')

	<!-- Javascript files -->
	<script type="text/javascript" src="/packages/dberry37388/honcho/js/jquery.min.js"></script>
	<script src="/packages/dberry37388/honcho/js/bootstrap.js"></script>

</body>
</html>