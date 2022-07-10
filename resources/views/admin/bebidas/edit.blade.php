<x-layouts.admin title="Editar bebida">
	<x-slot name="header">
		<x-breadcrumb :rutas="[
		    [
		        'url' => route('bebidas.index'),
		        'label' => 'Bebidas',
		    ],
		    [
		        'url' => '',
		        'label' => 'Editar',
		    ],
		]" />
	</x-slot>

	<section>
		<h2 class="h2 mb-6 text-center">
			Editar bebida
		</h2>
		<form
			action="{{ route('bebidas.update', $bebida) }}"
			method="post"
			enctype="multipart/form-data"
			role="form"
		>
			@method('put')
			@include('admin.alimentos._form', [
			    'btnText' => 'Actualizar',
			    'data' => $bebida,
			])
		</form>
	</section>

	<x-slot name="scripts">
		<script>
		 window.APP_URL = '{{ url('/') }}';
		</script>
	</x-slot>
</x-layouts.admin>
