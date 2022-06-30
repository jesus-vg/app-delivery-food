<x-app-layout>

	<x-slot name="styles">
		{{-- https://leafletjs.com/download.html --}}
		{{-- leaflet --}}
		<link
			rel="stylesheet"
			href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
			integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
			crossorigin=""
		/>
		<script
		 src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
		 integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
		 crossorigin=""
		></script>
		{{-- end leaflet --}}

		{{-- https://github.com/Esri/esri-leaflet-geocoder/ --}}
		{{-- esri-leaflet-geocoder --}}
		<!-- Load Esri Leaflet from CDN -->
		<script src="https://unpkg.com/esri-leaflet"></script>
		<!-- Esri Leaflet Geocoder -->
		<link
			rel="stylesheet"
			href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
		/>
		<script src="https://unpkg.com/esri-leaflet-geocoder"></script>
		{{-- end esri-leaflet-geocoder --}}

		{{-- https://smeijer.github.io/leaflet-geosearch/ --}}
		{{-- leaflet-geosearch --}}
		<link
			rel="stylesheet"
			href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"
		/>
		{{-- Make sure you put this AFTER leaflet.js, when using with leaflet --}}
		<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
		{{-- end leaflet-geosearch --}}

		{{-- dropzone --}}
		<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
		<link
			href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css"
			rel="stylesheet"
			type="text/css"
		/>
		{{-- end dropzone --}}
	</x-slot>


	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			Editar datos de la empresa
		</h2>
	</x-slot>

	<form
		method="post"
		action="{{ route('empresa.update', [$empresa]) }}"
	>
		@csrf
		@method('PUT')
		<div class="mb-4">
			<x-input-with-validation
				label="Nombre de la empresa"
				name="nombre"
				:errors="$errors?->get('nombre')"
				placeholder="Ej. Miscelanea San Juanito"
				type="text"
				:value="old('nombre', $empresa->nombre)"
			/>
		</div>

		<div class="mb-6">
			<x-input-with-validation
				label="Imagen principal"
				name="imagen_principal"
				:errors="$errors?->get('imagen_principal')"
				placeholder="Seleccione una imagen"
				type="file"
				acept="image/*"
			/>
			@if ($empresa->imagen_principal)
				<img
					src="storage/{{ $empresa->imagen_principal }}"
					alt="{{ $empresa->nombre }}"
					class="w-48 rounded-sm"
				>
			@endif
		</div>

		<div class="mb-6">
			<x-label
				for="descripcion"
				value="Descripción"
			/>
			<textarea
			 name="descripcion"
			 id="descripcion"
			 class="input-form @error('descripcion') border-red-500 @enderror"
			 rows="4"
			 placeholder="Descripción del establecimiento o negocio"
			>{{ old('descripcion', $empresa->descripcion) }}</textarea>
			<x-input-error :errors="$errors?->get('descripcion')" />
		</div>

		<div class="mb-4">
			<x-label value="Buscar dirección" />
			<buscar-direccion
				:oldlat="{{ old('latitud', $empresa->latitud) }}"
				:oldlng="{{ old('longitud', $empresa->longitud) }}"
			/>
		</div>
		<div class="mb-4">
			<x-input-with-validation
				label="Dirección"
				name="direccion"
				:errors="$errors?->get('direccion')"
				placeholder="Dirección del establecimiento o negocio"
				type="text"
				:value="old('direccion', $empresa->direccion)"
			/>
		</div>

		<div class="mb-4">
			<x-input-with-validation
				label="Colonia"
				name="colonia"
				:errors="$errors?->get('colonia')"
				placeholder="Ej. Av. Juarez"
				type="text"
				:value="old('colonia', $empresa->colonia)"
			/>
		</div>

		<div class="mb-4">
			<x-input-with-validation
				label="Teléfono"
				name="telefono"
				:errors="$errors?->get('telefono')"
				placeholder="Ej. 227 123 54 33"
				type="text"
				:value="old('telefono', $empresa->telefono)"
			/>
		</div>

		<div class="md:flex md:w-96">
			<div class="mb-4 md:w-56">
				<x-input-with-validation
					label="Hora de apertura"
					name="hora_apertura"
					:errors="$errors?->get('hora_apertura')"
					placeholder="Ej. 227 123 54 33"
					type="time"
					:value="old('hora_apertura', $empresa->hora_apertura)"
				/>
			</div>
			<div class="mb-4 pl-4 md:w-56">
				<x-input-with-validation
					label="Hora de cierre"
					name="hora_cierre"
					:errors="$errors?->get('hora_cierre')"
					placeholder="Ej. 227 123 54 33"
					type="time"
					:value="old('hora_cierre', $empresa->hora_cierre)"
				/>
			</div>
		</div>
		<div class="text-center">
			<button
				type="submit"
				class="btn-primary"
			>Guardar</button>
		</div>
	</form>

	<x-slot name="scripts">
		<script>
		 window.APP_URL = '{{ url('/') }}';
		</script>
	</x-slot>
</x-app-layout>
