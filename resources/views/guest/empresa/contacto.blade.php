<x-layouts.customer title="Contacto">

	<x-slot name="styles">
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
	</x-slot>
	<x-slot name="header">
		<x-breadcrumb />
	</x-slot>

	<section class="text-gray-600">
		<h1 class="h1 text-center">{{ $infoEmpresa->nombre }}</h1>
		<x-separador class="py-4 text-center" />

		<h2 class="h2 pt-8 text-center">Te invitamos a que nos visites en nuestra siguiente dirección </h2>
		{{-- @dump($infoEmpresa) --}}

		<p class="pb-8 text-center">
			Estamos ubicados en {{ $infoEmpresa->direccion }}, {{ $infoEmpresa->colonia }} o puedes llamarnos al Tel.
			{{ $infoEmpresa->telefono }} .
			<br>
			Atendemos de {{ $horaApertura }} a {{ $horaCierre }} los 7 dias de la semana, te
			esperamos.
		</p>
		<div
			id="mapa"
			class="z-0 mb-2 h-96 w-full rounded-lg border border-gray-300"
		></div>
		<p class="py-8">
			{{ $infoEmpresa->descripcion }}
		</p>
	</section>

	<x-slot name="scripts">
		<script>
		 const direccion = "{{ $infoEmpresa->direccion . ', ' . $infoEmpresa->colonia }} ";
		 const lat = {{ $infoEmpresa->latitud }};
		 const lng = {{ $infoEmpresa->longitud }};
		 const zoom = 16;
		 const mapa = L.map("mapa").setView([lat, lng], zoom);

		 L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
		  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
		 }).addTo(mapa);

		 const marker = new L.marker([lat, lng], {
		   autoPan: true,
		  }).addTo(mapa)
		  .bindPopup(
		   `<p class="text-xs text-gray-600">${direccion}</p>`
		  )
		  .openPopup();
		</script>
	</x-slot>

</x-layouts.customer>
