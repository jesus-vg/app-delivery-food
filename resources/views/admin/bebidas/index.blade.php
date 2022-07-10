<x-layouts.admin title="Bebidas">
	<x-slot name="header">
		<x-breadcrumb :rutas="[['label' => 'Bebidas']]" />
	</x-slot>

	<section>
		<div class="mb-4 flex items-center justify-between">
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

		@if (count($bebidas) > 0)
			@include('admin.alimentos._tabla_bebidas_alimentos', [
			    'data' => $bebidas,
			    'rutaEditar' => 'bebidas.edit',
			    'rutaEliminar' => 'bebidas.destroy',
			])
		@else
			@include('partials._sin_registros')
		@endif

		<div class="py-4">
			<a
				href="{{ route('categoria_bebidas.index') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-800"
			>
				Administrar categorias
			</a>
		</div>
	</section>
</x-layouts.admin>
