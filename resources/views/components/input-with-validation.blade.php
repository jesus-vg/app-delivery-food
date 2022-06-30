{{-- props para el input del formulario --}}
@props([
    'label' => '',
    'name' => '',
    'errors' => [],
])
<label
	for="{{ $name }}"
	class="label"
>
	{{ $label }}
</label>

<input
	id="{{ $name }}"
	name="{{ $name }}"
	class="input-form"
	{{ $attributes }}
>

<x-input-error :errors="$errors" />

{{-- TODO: usar los compoentes de breeze para input y label --}}
{{-- <x-label
	for="email"
	:value="__('Email')"
/>

<x-input
	id="email"
	class="input-form"
	type="email"
	name="email"
	:value="old('email')"
	required
	autofocus
/> --}}
