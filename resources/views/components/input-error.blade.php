@props([
    'errors' => [],
])

@if ($errors)
	@foreach ($errors as $error)
		<p class="text-sm text-red-500">{{ $error }}</p>
	@endforeach
@endif
