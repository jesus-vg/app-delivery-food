<x-app-layout>
	<x-slot name="header">
		<h2 class="h2">
			Editar bebida
		</h2>
	</x-slot>

	<section>
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
</x-app-layout>
