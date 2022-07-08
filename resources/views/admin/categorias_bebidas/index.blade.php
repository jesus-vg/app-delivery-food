<x-app-layout>
	<x-slot name="header">
		@include('partials._bradcrumb', [
		    'rutas' => [
		        [
		            'url' => route('bebidas.index'),
		            'label' => 'Bebidas',
		        ],
		        [
		            'url' => '',
		            'label' => 'Categorias',
		        ],
		    ],
		])
	</x-slot>

	<section>
		<div class="mb-4">
			<fieldset class="my-4 rounded border border-gray-200 p-4">
				<legend class="text-base font-bold uppercase tracking-wide text-gray-600">
					Agregar nueva categoría
				</legend>
				<form
					action="{{ route('categoria_bebidas.store') }}"
					method="post"
				>
					@include('admin.categorias_alimentos._form')
				</form>
			</fieldset>
		</div>

		@if (count($categorias) > 0)
			<modal ref="modalEditarCategoria"></modal>
			<h2 class="h2 mb-4 text-center">
				Categorias disponibles
			</h2>
			@include('admin.categorias_alimentos._table', [
			    'categorias' => $categorias,
			    'rutaUpdate' => 'categoria_bebidas.update',
			    'rutaDestroy' => 'categoria_bebidas.destroy',
			])
		@else
			@include('partials._sin_registros')
		@endif
	</section>
</x-app-layout>
