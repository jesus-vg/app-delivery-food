@csrf
<x-auth-validation-errors
	class="mb-4"
	:errors="$errors"
/>
<div class="mb-4 w-full sm:w-1/2">
	<x-input-with-validation
		label="Nombre"
		name="nombre"
		:errors="[]"
		placeholder="Ingrese una categoría"
		type="text"
		:value="old('nombre')"
	/>
</div>

<div class="mb-4">
	<div class="flex items-center">
		<input
			id="checked-checkbox"
			type="checkbox"
			name="activo"
			class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
			@checked(old('activo') === 'on')
		/>
		<label
			for="checked-checkbox"
			class="ml-2 text-sm font-medium text-gray-600"
		>
			Activo / No activo
		</label>
	</div>
</div>
<div class="mb4">
	<button
		type="submit"
		class="btn-primary"
	>
		Agregar
	</button>
</div>
