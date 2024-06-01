<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('admin_resources/img/icons/icon-48x48.png') }}" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<title>@yield('title')</title>
	<link href="{{ asset('admin_resources/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/toastify.min.css') }}">
	@yield('css')
</head>

<body>
	<div class="wrapper">
		@include('admin.components.sidebar')

		<div class="main">
			@include('admin.components.header')

			<main class="content p-4">
				@yield('content')
			</main>

			@include('admin.components.footer')
		</div>
	</div>

	<script src="{{ asset('admin_resources/js/app.js') }}"></script>
	<script src="{{ asset('js/toastify-js.js') }}"></script>

	@if(session('success'))
	<script>
		Toastify({
			text: "{{ session('success') }}",
			close: true,
			backgroundColor: "linear-gradient(to right, #269E70, #00BFA6)",
			className: "success",
		}).showToast();
	</script>
	@endif

	@if(session('error'))
	<script>
		Toastify({
			text: "{{ session('error') }}",
			close: true,
			backgroundColor: "linear-gradient(to right, #6E32CF, #FFA300)",
			className: "error",
		}).showToast();
	</script>
	@endif

	@yield('script')
</body>

</html>