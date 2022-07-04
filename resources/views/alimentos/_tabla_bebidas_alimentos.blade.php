<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
	<table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
		<thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
			<tr>
				<th
					scope="col"
					class="px-6 py-3"
				>
					Descripción
				</th>
				<th
					scope="col"
					class="px-6 py-3"
				>
					Precio
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
					Estado
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
			@foreach ($data as $item)
				<tr
					class="border-b odd:bg-white even:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 odd:dark:bg-gray-800 even:dark:bg-gray-700"
				>
					<th class="px-6 py-4 font-medium text-gray-900 dark:text-white">
						<strong>{{ $item->nombre }}</strong>
						<br>
						{{ $item->descripcion }}
						<br>
						<small>
							- {{ $item->categoria->nombre }}
						</small>
					</th>
					<td class="px-6 py-4">
						{{ number_format($item->precio, 2, '.', ',') }}
					</td>
					<td class="px-6 py-4">
						{{ $item->created_at->format('d/m/Y') }}
						<br>
						{{ $item->created_at->diffForHumans() }}
					</td>
					<td class="px-6 py-4">
						{{ $item->activo ? 'Activo' : 'Desactivo' }}
					</td>
					<td class="px-6 py-4">
						<a
							href="{{ route($rutaEditar, $item) }}"
							class="px-1 text-sm text-green-500"
						>
							Editar
						</a>
						<eliminar-elemento url="{{ route($rutaEliminar, $item) }}" />
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="my-4 text-center">
	{{ $data->links() }}
</div>
