<x-app-layout>
	<x-slot name="header">
		@include('partials._bradcrumb', [
		    'rutas' => [
		        [
		            'url' => route('bebidas.index'),
		            'label' => 'Bebidas',
		        ],
		    ],
		])
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

		<div class="my-4">
			<a
				href="{{ route('categoria_bebidas.index') }}"
				class="btn-secondary"
			>
				Administrar categorias
			</a>
		</div>
	</section>
</x-app-layout>
