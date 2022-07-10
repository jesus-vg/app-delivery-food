<x-layouts.admin title="Inicio">
	<x-slot name="header">
		<x-breadcrumb />
	</x-slot>

	<section>
		<h2 class="h2 mb-4 text-center">
			Hola, <span class="font-medium">{{ auth()->user()->name }}</span>
		</h2>
		<x-separador class="pt-4 text-center" />
		<h3 class="h3 py-8 text-center">Elige la actividad que desea realizar en las siguientes opciones</h3>
		<main class="flex flex-wrap items-center justify-center pb-4">
			<a
				href="{{ route('alimentos.index') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800"
			>
				Alimentos
			</a>
			<a
				href="{{ route('bebidas.index') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-green-400 via-green-500 to-green-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800"
			>
				Bebidas
			</a>
			<a
				href="{{ route('clientes.index') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-cyan-300 dark:focus:ring-cyan-800"
			>
				Clientes registrados
			</a>
			<a
				href="{{ route('clientes.index') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-800"
			>
				Pedidos
			</a>
			<a
				href="{{ route('empresa.edit') }}"
				class="mr-2 mb-2 rounded-lg bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-br focus:outline-none focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800"
			>
				Actualizar datos de la emppresa
			</a>
		</main>
	</section>
</x-layouts.admin>
