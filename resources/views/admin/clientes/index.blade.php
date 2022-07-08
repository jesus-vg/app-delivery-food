<x-app-layout>
	<x-slot name="header">
		@include('partials._bradcrumb', [
		    'rutas' => [
		        [
		            'url' => route('clientes.index'),
		            'label' => 'Clientes',
		        ],
		    ],
		])
	</x-slot>

	<section>
		<h2 class="h2 mb-4 text-center">
			Clientes registrados
		</h2>

		@php
			$messageConfirmacion = ' seleccionado, se eliminará toda la información relacionada a este usuario, <strong>no habrá vuelta atrás</strong><br>¿Desea continuar?';
		@endphp
		@if (count($clientes) > 0)
			<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
				<table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
					<thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
						<tr>
							<th
								scope="col"
								class="px-6 py-3"
							>
								Nombre
							</th>
							<th
								scope="col"
								class="px-6 py-3"
							>
								Fecha registro
							</th>
							<th
								scope="col"
								class="px-6 py-3"
							>
								Dirección
							</th>
							<th
								scope="col"
								class="px-6 py-3"
							>
								<span class="sr-only">Opciones</span>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($clientes as $cliente)
							<tr
								class="border-b odd:bg-white even:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 odd:dark:bg-gray-800 even:dark:bg-gray-700"
							>
								<th class="px-6 py-4 font-medium text-gray-900 dark:text-white">
									<strong>{{ $cliente->name }}</strong>
									<br>
									<small>
										- {{ $cliente->email }}
									</small>
								</th>
								<td class="px-6 py-4">
									{{ $cliente->created_at?->format('d/m/Y') }}
									<br>
									{{ $cliente->created_at?->diffForHumans() }}
								</td>
								<td class="px-6 py-4">
									@php
										$direccion = $cliente->direccion?->direccion . ', ' . $cliente->direccion?->colonia;
									@endphp
									{{ $direccion ?? 'no hay direccion' }}
									<br>
									-<small><strong>Referencia </strong>{{ $cliente->direccion?->referencia }}</small>
								</td>
								<td class="px-6 py-4">
									<eliminar-elemento
										url="{{ route('clientes.destroy', $cliente) }}"
										message="{{ 'Cliente <strong>' . $cliente->name . '</strong>' . $messageConfirmacion }}"
									></eliminar-elemento>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="my-4 text-center">
				{{ $clientes->links() }}
			</div>
		@else
			@include('partials._sin_registros')
		@endif
	</section>
</x-app-layout>
