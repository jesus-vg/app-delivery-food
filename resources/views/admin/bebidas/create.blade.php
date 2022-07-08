<x-app-layout>
	<x-slot name="header">
		<h2 class="h2">
			Agregar nueva bebida
		</h2>
	</x-slot>

	<section>
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
</x-app-layout>
