<x-layouts.customer title="Inicio">
	<x-slot name="header">
		<x-breadcrumb :rutas="[]" />
	</x-slot>

	<section>
		<x-greeting :name="auth()->user()->name" />
		<x-separador class="pt-4" />
		<h1 class="h3 py-8 text-center">Elige la actividad que desea realizar en las siguientes opciones</h1>
		<main class="flex flex-wrap items-center justify-center pb-4">
			<a
				href="{{ route('clientes.index') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-800"
			>
				Ver pedidos

			</a>
			<a
				href="{{ route('empresa.edit') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800"
			>
				Actualizar datos de la cuenta
			</a>
		</main>
		@if (!auth()->user()->direccion)
			<div
				class="rounded-lg bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 py-4 px-5 text-center text-sm text-yellow-800 hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-800"
				role="alert"
			>
				<span class="font-medium">¡Aún no has agregado tu dirección!</span> Agrega tu dirección para que podamos brindarte un
				mejor servicio
			</div>
		@endif

	</section>
</x-layouts.customer>
