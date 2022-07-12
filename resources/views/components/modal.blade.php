@props(['label' => 'Label', 'title' => 'Title'])
<button x-on:click="isModalOpen = true">{{ $label }}</button>
<div
	id="modal"
	tabindex="-1"
	aria-hidden="true"
	class="h-modal fixed top-0 right-0 left-0 z-50 hidden h-full w-full overflow-y-auto overflow-x-hidden bg-gray-900/50 md:inset-0"
	x-show="isModalOpen"
	x-cloak
	x-transition
	:class="{ 'flex items-center justify-center': isModalOpen, 'hidden': !isModalOpen }"
>
	<div
		class="relative h-auto w-full max-w-2xl p-4"
		x-on:click.away="isModalOpen = false"
	>
		<!-- Modal content -->
		<div
			class="relative rounded-lg bg-white text-gray-600 shadow"
			id="contentModal"
		>
			<!-- Modal header -->
			<div class="flex items-start justify-between rounded-t border-b border-gray-200 p-4">
				<h3 class="text-lg font-medium text-gray-600">{{ $title }}</h3>
				<button
					type="button"
					class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
					data-modal-toggle="defaultModal"
					x-on:click="isModalOpen = false"
				>
					<svg
						class="h-5 w-5"
						fill="currentColor"
						viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path
							fill-rule="evenodd"
							d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
							clip-rule="evenodd"
						></path>
					</svg>
				</button>
			</div>
			<!-- Modal body -->
			<div class="space-y-6 p-6">
				{{ $body }}
			</div>
			<!-- Modal footer -->
			<div class="flex items-center space-x-2 rounded-b border-t border-gray-200 p-6">
				{{ $footer ?? '' }}
			</div>
		</div>
	</div>
</div>
