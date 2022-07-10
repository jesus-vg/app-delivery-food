<x-layouts.admin title="Crear bebida">
	<x-slot name="header">
		<x-breadcrumb :rutas="[
		    [
		        'url' => route('bebidas.index'),
		        'label' => 'Bebidas',
		    ],
		    [
		        'url' => '',
		        'label' => 'Agregar',
		    ],
		]" />
	</x-slot>

	<section>
		<h2 class="h1 mb-6 text-center">
			Agregar nueva bebida
		</h2>
		<form
			action="{{ route('bebidas.store') }}"
			method="post"
			enctype="multipart/form-data"
			role="form"
		>
			@include('admin.alimentos._form', [
			    'btnText' => 'Agregar',
			    'data' => $bebida,
			])
		</form>
	</section>
</x-layouts.admin>
