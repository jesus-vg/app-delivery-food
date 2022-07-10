@props(['name' => ''])

<p {!! $attributes->merge(['class' => 'greeting']) !!}>
	@if (session('greeting'))
		<span>Hola {{ $name }}</span>, bienvenido de nuevo
	@else
		@php
			$greeting = '';

			$HoraTiempoReal = date('G');

			if ($HoraTiempoReal < 12) {
			$greeting = 'Buenos días, ';
			} elseif ($HoraTiempoReal >= 12 && $HoraTiempoReal < 19) {
			$greeting = 'Buenas tardes, ';
			} else {
			$greeting = 'Buenas noches, ';
			}
		@endphp
		{{-- @dump($HoraTiempoReal) --}}
		{{ $greeting }} <span>{{ $name }}</span>
	@endif
</p>
