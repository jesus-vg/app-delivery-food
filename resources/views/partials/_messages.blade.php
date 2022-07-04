@if (session('success'))
	<div
		class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700 dark:bg-green-200 dark:text-green-800"
		role="alert"
	>
		<span class="font-medium">OK!</span> {{ session('success') }}
	</div>
@endif
