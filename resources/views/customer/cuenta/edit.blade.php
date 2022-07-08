<x-cliente-layout>
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
		@include('partials._bradcrumb', [
		    'rutas' => [
		        [
		            'url' => route('clientes.index'),
		            'label' => 'Cuenta',
		        ],
		    ],
		])
		{{-- @dump($user->direccion()) --}}
	</x-slot>

	<section>
		<h2 class="h2 mb-4 text-center">
			Editar cuenta
		</h2>
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
			<fieldset class="my-4 rounded border border-gray-200 p-4">
				<legend class="text-base font-bold uppercase tracking-wide text-gray-600">
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
			<fieldset class="my-4 rounded border border-gray-200 p-4">
				<legend class="text-base font-bold uppercase tracking-wide text-gray-600">
					Datos de la dirección
				</legend>
				@if (!$user->direccion)
					<div
						class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-200 dark:text-red-800"
						role="alert"
					>
						<span class="font-bold">¡No has agregado tu dirección!</span> Agrega tu dirección para poder realizar tus
						pedidos
					</div>
				@endif
				<div class="mb-4">
					<x-label value="Buscar dirección" />
					<buscar-direccion
						:oldlat="{{ old('latitud', $user->direccion?->latitud) }}"
						:oldlng="{{ old('longitud', $user->direccion?->longitud) }}"
					/>
				</div>
				<div class="mb-4">
					<x-input-with-validation
						label="Dirección"
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
						label="Teléfono"
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
			datos e información de tu ubicación para que podamos brindarte un mejor servicio.
		</div>
		@php
			$messageConfirmacion = 'Tu cuenta se eliminará y toda la información relacionada, <strong>no habrá vuelta atrás</strong><br>¿Deseas continuar?';
		@endphp
		<hr class="my-8 mx-auto w-1/2">
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
</x-cliente-layout>
