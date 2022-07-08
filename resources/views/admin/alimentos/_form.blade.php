@csrf

<div class="mb4">
	<x-auth-validation-errors
		class="mb-4"
		:errors="$errors"
	/>
</div>

<div class="mb-4">
	<x-input-with-validation
		label="Nombre"
		name="nombre"
		:errors="$errors?->get('nombre')"
		placeholder="Ingrese un nombre"
		type="text"
		:value="old('nombre', $data->nombre)"
	/>
</div>

<div class="mb-4">
	<x-label
		for="categoria_alimento_id"
		value="Seleccione una categoria"
	/>
	<v-select
		data="{{ json_encode($categorias) }}"
		value="{{ old('categoria_alimento_id', $data->categoria_alimento_id) }}"
		name="categoria_alimento_id"
	/>
</div>

<div class="mb-4">
	<x-label
		for="descripcion"
		value="Descripción"
	/>
	<textarea
	 name="descripcion"
	 id="descripcion"
	 class="input-form @error('descripcion') border-red-500 @enderror"
	 rows="4"
	 placeholder="Descripción"
	>{{ old('descripcion', $data->descripcion) }}</textarea>
	<x-input-error :errors="$errors?->get('descripcion')" />
</div>


<div class="mb-4">
	<x-input-with-validation
		label="Imagen"
		name="imagen"
		:errors="$errors?->get('imagen')"
		placeholder="Seleccione una imagen"
		type="file"
		acept="image/*"
	/>
	@if ($data->imagen)
		<div class="flex flex-wrap items-center">
			<span class="label">imágen actual</span>
			<img
				src="{{ route('imagen.getImagenMini', ['path' => str_replace('/', '-', $data->imagen)]) }}"
				alt="{{ $data->nombre }}"
				class="m-4 h-32 w-60 rounded-sm object-cover"
			>
			<small class="text-xs text-blue-600">Si seleciona otra imagen, este será reemplazado</small>
		</div>
	@endif
</div>

<div class="sm:flex">
	<div class="mb-4">
		<x-input-with-validation
			label="Precio"
			name="precio"
			:errors="$errors?->get('precio')"
			placeholder="0.00"
			type="number"
			step="0.1"
			min="1"
			value="{{ old('precio', $data->precio) }}"
		/>
	</div>
	<div class="mb-4 sm:ml-4 sm:w-40">
		<div class="w-20">
			<x-label
				for="activo"
				value="Activo"
			/>
			<input
				type="checkbox"
				name="activo"
				id="activo"
				class="input-form @error('activo') border-red-500 @enderror"
				@checked(old('activo', $data->activo))
			>
		</div>
		<x-input-error :errors="$errors?->get('activo')" />
	</div>
</div>

<div class="text-center">
	<button
		type="submit"
		class="btn-primary"
	>
		{{ $btnText }}
	</button>
</div>
