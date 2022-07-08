<x-cliente-layout>
	<x-slot name="header">
		@include('partials._bradcrumb', [
		    'rutas' => [],
		])
	</x-slot>

	<section>
		<h2 class="h2 mb-4 text-center">
			Hola
		</h2>
	</section>
</x-cliente-layout>
