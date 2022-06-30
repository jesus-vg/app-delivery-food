<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1"
	>
	<meta
		name="csrf-token"
		content="{{ csrf_token() }}"
	>

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link
		rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
	>

	<!-- Styles -->
	<link
		rel="stylesheet"
		href="{{ asset('css/app.css') }}"
	>

	<!-- Scripts -->
	<script
	 src="{{ asset('js/app.js') }}"
	 defer
	></script>

	{{-- styles custom --}}
	{{ $styles ?? '' }}
</head>

<body class="font-sans antialiased">
	@include('partials._messages')
	<div class="min-h-screen bg-gray-100">
		@include('layouts.navigation')

		<!-- Page Heading -->
		<header class="bg-white shadow">
			<div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
				{{ $header }}
			</div>
		</header>

		<!-- Page Content -->
		<main>
			<div class="py-12">
				<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
					<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
						{{-- <div class="bg-white shadow-sm sm:rounded-lg"> --}}
						<div class="app border-b border-gray-200 bg-white p-6">
							{{ $slot }}
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	{{-- scripts custom --}}
	{{ $scripts ?? '' }}
</body>

</html>
