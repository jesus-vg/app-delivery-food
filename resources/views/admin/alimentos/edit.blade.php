<x-layouts.admin title="Editar alimento">
	<x-slot name="header">
		<x-breadcrumb :rutas="[
		    [
		        'url' => route('alimentos.index'),
		        'label' => 'Alimentos',
		    ],
		    [
		        'url' => '',
		        'label' => 'Editar',
		    ],
		]" />
	</x-slot>

	<section>
		<h2 class="h2 mb-6 text-center">
			Editar alimento
		</h2>
		<form
			action="{{ route('alimentos.update', $alimento) }}"
			method="post"
			enctype="multipart/form-data"
			role="form"
		>
			@method('put')
			@include('admin.alimentos._form', [
			    'btnText' => 'Actualizar',
			    'data' => $alimento,
			])
		</form>
	</section>

	<x-slot name="scripts">
		<script>
		 window.APP_URL = '{{ url('/') }}';
		</script>
	</x-slot>
</x-layouts.admin>
