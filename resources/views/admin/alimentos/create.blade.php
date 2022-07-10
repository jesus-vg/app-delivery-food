<x-layouts.admin title="Crear alimento">
	<x-slot name="header">
		<x-breadcrumb :rutas="[
		    [
		        'url' => route('alimentos.index'),
		        'label' => 'alimentos',
		    ],
		    [
		        'url' => '',
		        'label' => 'agregar',
		    ],
		]" />
	</x-slot>

	<section>
		<h2 class="h2 mb-6 text-center">
			Agregar nuevo alimento
		</h2>
		<form
			action="{{ route('alimentos.store') }}"
			method="post"
			enctype="multipart/form-data"
			role="form"
		>
			@include('admin.alimentos._form', [
			    'btnText' => 'Agregar',
			    'data' => $alimento,
			])
		</form>
	</section>
</x-layouts.admin>
