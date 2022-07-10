<x-layouts.admin title="Alimentos">
	<x-slot name="header">
		<x-breadcrumb :rutas="[['label' => 'Alimentos']]" />
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
			@include('admin.alimentos._tabla_bebidas_alimentos', [
			    'data' => $alimentos,
			    'rutaEditar' => 'alimentos.edit',
			    'rutaEliminar' => 'alimentos.destroy',
			])
		@else
			@include('partials._sin_registros')
		@endif

		<div class="py-4">
			<a
				href="{{ route('categoria_alimentos.index') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-800"
			>
				Administrar categorias
			</a>
		</div>
	</section>
</x-layouts.admin>
