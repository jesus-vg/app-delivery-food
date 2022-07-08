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
					Estado
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
					<span class="sr-only">Opciones</span>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($categorias as $item)
				<tr
					class="border-b odd:bg-white even:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 odd:dark:bg-gray-800 even:dark:bg-gray-700"
				>
					<th class="px-6 py-4 font-medium text-gray-900 dark:text-white">
						<strong>{{ $item->nombre }}</strong>
					</th>
					<td class="px-6 py-4">
						{{ $item->activo ? 'Activo' : 'Desactivo' }}
					</td>
					<td class="px-6 py-4">
						{{ $item->created_at?->format('d/m/Y') }}
						<br>
						{{ $item->created_at?->diffForHumans() }}
					</td>
					<td class="px-6 py-4">
						@php
							$ruta = route($rutaUpdate, [$item]);
						@endphp
						<editar-elemento
							@click="$refs.modalEditarCategoria.setDataModal({{ json_encode($item) }}, '{{ $ruta }}')"
						></editar-elemento>
						<eliminar-elemento url="{{ route($rutaDestroy, $item) }}"></eliminar-elemento>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="my-4 text-center">
	{{ $categorias->links() }}
</div>
