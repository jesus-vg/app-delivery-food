<x-layouts.customer title="Editar cuenta">

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
	</x-slot>


	<x-slot name="header">
		<x-breadcrumb :rutas="[
		    [
		        'label' => 'Editar cuenta',
		    ],
		]" />
	</x-slot>

	<section class="app">
		<h2 class="h2 mb-4 text-center">
			Editar cuenta
		</h2>
		<x-separador class="mb-4 text-center" />
		<form
			action="{{ route('cuenta.update', $user) }}"
			method="POST"
		>
			@csrf
			@method('PUT')
			<!-- Validation Errors -->
			<x-auth-validation-errors
				class="mb-4"
				:errors="$errors"
			/>
			<fieldset class="my-4 rounded border border-gray-300 p-4">
				<legend class="text-base font-semibold uppercase tracking-wide text-gray-600">
					Datos del usuario
				</legend>
				<div class="mb-4">
					<x-input-with-validation
						label="Nombre"
						name="name"
						:errors="[]"
						placeholder="Ingresa tu nombre"
						type="text"
						:value="old('name', $user->name)"
					/>
				</div>
				<div class="mb-4">
					<x-label
						for="email"
						:value="__('Email')"
					/>
					<x-input
						id="email"
						type="email"
						disabled
						aria-disabled="true"
						:value="$user->email"
					/>
				</div>
				<update-password old-error=""></update-password>
			</fieldset>

			<fieldset class="my-4 rounded border border-gray-300 p-4">
				<legend class="text-base font-semibold uppercase tracking-wide text-gray-600">
					Datos de la direcci??n
				</legend>
				@if (!$user->direccion)
					<div
						class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-200 dark:text-red-800"
						role="alert"
					>
						<span class="font-bold">??No has agregado tu direcci??n!</span> Agrega tu direcci??n para poder realizar tus
						pedidos
					</div>
				@endif
				<div class="mb-4">
					<x-label value="Buscar direcci??n" />
					<buscar-direccion
						:oldlat="{{ old('latitud', $user->direccion?->latitud) }}"
						:oldlng="{{ old('longitud', $user->direccion?->longitud) }}"
					/>
				</div>
				<div class="mb-4">
					<x-input-with-validation
						label="Direcci??n"
						name="direccion"
						:errors="$errors?->get('direccion')"
						placeholder="Ej. Calle 5 de mayo"
						type="text"
						:value="old('direccion', $user->direccion?->direccion)"
					/>
				</div>

				<div class="mb-4">
					<x-input-with-validation
						label="Colonia"
						name="colonia"
						:errors="$errors?->get('colonia')"
						placeholder="Ej. Av. Juarez"
						type="text"
						:value="old('colonia', $user->direccion?->colonia)"
					/>
				</div>

				<div class="mb-4">
					<x-input-with-validation
						label="Indicanos una referencia"
						name="referencia"
						:errors="$errors?->get('referencia')"
						placeholder="Ej. Esq. con calle las rosas puerta gris"
						type="text"
						:value="old('referencia', $user->direccion?->referencia)"
					/>
				</div>

				<div class="mb-4">
					<x-input-with-validation
						label="Tel??fono"
						name="telefono"
						:errors="$errors?->get('telefono')"
						placeholder="Ej. 227 123 54 33"
						type="text"
						:value="old('telefono', $user->telefono)"
					/>
				</div>
			</fieldset>
			<div class="text-center">
				{{-- el atributo ref se usa en el componente updatePassword --}}
				<button
					class="btn-primary"
					type="submit"
					ref="btnSendForm"
				>Actualizar</button>
			</div>
		</form>
		<div
			class="mb-4 mt-10 rounded-lg bg-blue-100 p-4 text-sm text-blue-700 dark:bg-blue-200 dark:text-blue-800"
			role="alert"
		>
			<span class="font-bold">Estimado usuario,</span> te pedimos encarecidamente que tengas actualizado siempre tus
			datos e informaci??n de tu ubicaci??n para que podamos brindarte un mejor servicio.
		</div>
		@php
			$messageConfirmacion = 'Tu cuenta se eliminar?? y toda la informaci??n relacionada, <strong>no habr?? vuelta atr??s</strong><br>??Deseas continuar?';
		@endphp
		<x-separador class="py-4 text-center" />
		<div class="hidden">
			<eliminar-elemento
				url="{{ route('cuenta.destroy', $user) }}"
				message="{{ $messageConfirmacion }}"
				ref="confirmarEliminar"
			></eliminar-elemento>
		</div>
		<div class="my-4 text-center">
			<button
				class="btn-delete"
				@click="$refs.confirmarEliminar.eliminar()"
			>Eliminar</button>
		</div>
	</section>
</x-layouts.customer>
