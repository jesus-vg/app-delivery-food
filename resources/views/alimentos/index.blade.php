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
			@include('alimentos._tabla_bebidas_alimentos', [
			    'data' => $alimentos,
			    'rutaEditar' => 'alimentos.edit',
			    'rutaEliminar' => 'alimentos.destroy',
			])
		@else
			@include('partials._sin_registros')
		@endif

		<div class="my-4">
			<a
				href="{{ route('categoria_alimentos.index') }}"
				class="btn-secondary"
			>
				Administrar categorias
			</a>
		</div>
	</section>
</x-app-layout>
