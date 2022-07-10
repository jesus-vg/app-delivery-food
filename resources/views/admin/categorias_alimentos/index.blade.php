<x-layouts.admin title="Administrar categorías">
	<x-slot name="header">
		<x-breadcrumb :rutas="[
		    [
		        'url' => route('alimentos.index'),
		        'label' => 'Alimentos',
		    ],
		    [
		        'url' => '',
		        'label' => 'Categorías',
		    ],
		]" />
	</x-slot>

	<section>
		<div class="mb-4">
			<fieldset class="my-4 rounded border border-gray-200 p-4">
				<legend class="text-base font-bold uppercase tracking-wide text-gray-600">
					Agregar nueva categoría
				</legend>
				<form
					action="{{ route('categoria_alimentos.store') }}"
					method="post"
				>
					@include('admin.categorias_alimentos._form')
				</form>
			</fieldset>
		</div>

		@if (count($categorias) > 0)
			<modal ref="modalEditarCategoria"></modal>
			<h2 class="h2 mb-4 text-center">
				Categorías disponibles
			</h2>
			@include('admin.categorias_alimentos._table', [
			    'categorias' => $categorias,
			    'rutaUpdate' => 'categoria_alimentos.update',
			    'rutaDestroy' => 'categoria_alimentos.destroy',
			])
		@else
			@include('partials._sin_registros')
		@endif
	</section>
</x-layouts.admin>
