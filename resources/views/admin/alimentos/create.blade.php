<x-app-layout>
	<x-slot name="header">
		@include('partials._bradcrumb', [
		    'rutas' => [
		        [
		            'url' => route('alimentos.index'),
		            'label' => 'Alimentos',
		        ],
		        [
		            'url' => '',
		            'label' => 'Agregar',
		        ],
		    ],
		])
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
</x-app-layout>
