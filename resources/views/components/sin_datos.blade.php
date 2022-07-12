@props(['message' => 'No hay registros por el momento'])

<p {!! $attributes->merge(['class' => 'text-2xl font-medium text-gray-500 text-center']) !!}>
	{{ $message }}
</p>
