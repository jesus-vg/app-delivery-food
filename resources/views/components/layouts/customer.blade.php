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

	<title>{{ config('app.name', 'Laravel') }} - {{ $title ?? 'Inicio' }}</title>

	<!-- Fonts -->
	<link
		rel="preconnect"
		href="https://fonts.googleapis.com"
	>
	<link
		rel="preconnect"
		href="https://fonts.gstatic.com"
		crossorigin
	>
	<link
		href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800&display=swap"
		rel="stylesheet"
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

<body
	class="font-sans antialiased"
	x-data="{ 'isModalOpen': false }"
	:class="{ 'overflow-hidden': isModalOpen, '': !isModalOpen }"
	x-on:keydown.escape="isModalOpen=false"
>
	<div class="flex min-h-screen flex-col bg-gray-100">
		<x-layouts.nav-guest />

		@if (isset($header))
			<!-- Page Heading -->
			<header class="bg-white shadow">
				<div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
					{{ $header }}
				</div>
			</header>
		@endif

		<!-- Page Content -->
		<main class="flex flex-1 items-center justify-center">
			<div class="w-full py-12">
				<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
					<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
						{{-- <div class="bg-white shadow-sm sm:rounded-lg"> --}}
						<div class="app border-b border-gray-200 bg-white p-6">
							@include('partials._messages')
							{{ $slot }}
						</div>
					</div>
				</div>
			</div>
		</main>

		<x-footer />

	</div>
	{{-- scripts custom --}}
	{{ $scripts ?? '' }}
</body>

</html>
