<x-app-layout>
	<x-slot name="header">
		@include('partials._bradcrumb', [
		    'rutas' => [
		        [
		            'url' => route('alimentos.index'),
		            'label' => 'Alimentos',
		        ],
		    ],
		])
	</x-slot>

	<section>
		<div class="mb-4 flex items-center justify-between">
			<h2 class="h2">
				Alimentos
			</h2>
			<div>
				<a
					href="{{ route('alimentos.create') }}"
					class="btn-primary"
				>Agregar</a>
			</div>
		</div>
		@if (count($alimentos) > 0)
			@include('partials._tabla_bebidas_alimentos', [
			    'data' => $alimentos,
			    'rutaEditar' => 'alimentos.edit',
			    'rutaEliminar' => 'alimentos.destroy',
			])
		@else
			<h3 class="h3 text-center">No hay registros por el momento</h3>
		@endif

		<div class="my-4">
			<a href="{{ route('categoria_alimentos.index') }}">Administrar categorias</a>
		</div>
	</section>
</x-app-layout>
