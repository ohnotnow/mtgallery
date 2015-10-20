<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_TITLE', 'Monkeytwizzle Photography') }}</title>
    <link rel="stylesheet" href="{{ asset('admin.css') }}" media="print,screen" />

</head>
<body>

	@include ('partials.navbar')

	<div class="container">

		<noscript>
			<div class="alert alert-danger"><strong>Warning:</strong> This site will not work correctly without javascript</div>
		</noscript>

		@include ('partials.alerts')

        @yield('content')
	</div><!-- container -->
    <script src="{{ asset('admin.js') }}"></script>
</body>
</html>
