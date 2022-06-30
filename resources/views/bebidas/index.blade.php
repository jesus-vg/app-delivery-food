<x-app-layout>
	<x-slot name="header">
		<div class="flex items-center justify-between">
			<h2 class="h2">
				Bebidas
			</h2>
			<div>
				<a
					href="{{ route('bebidas.create') }}"
					class="btn-primary"
				>Agregar</a>
			</div>
		</div>
	</x-slot>

	<section>
		@if (count($bebidas) > 0)
			@include('partials._tabla_bebidas_alimentos', [
			    'data' => $bebidas,
			    'rutaEditar' => 'bebidas.edit',
			    'rutaEliminar' => 'bebidas.destroy',
			])
		@else
			<h3 class="h3 text-center">No hay registros por el momento</h3>
		@endif
	</section>
</x-app-layout>
