<template>
    <div
        id="modal"
        tabindex="-1"
        aria-hidden="true"
        class="hidden h-modal fixed top-0 right-0 left-0 z-50 w-full overflow-y-auto overflow-x-hidden md:inset-0 h-full bg-gray-900/50"
        @keyup.esc="closeModal"
    >
        <div class="relative w-full max-w-2xl p-4 h-auto">
            <!-- Modal content -->
            <div
                class="relative rounded-lg bg-white shadow text-gray-600"
                id="contentModal"
            >
                <!-- Modal header -->
                <div
                    class="flex items-start justify-between rounded-t border-b p-4 border-gray-200"
                >
                    <h3 class="h3">Actualizar categoría</h3>
                    <button
                        type="button"
                        class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal"
                        @click="closeModal"
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
                    <template v-if="getErrors.nombre">
                        <div class="font-medium text-red-600">
                            Whoops! Algo salió mal.
                        </div>

                        <ul
                            class="mt-2 list-disc list-inside text-sm text-red-600"
                        >
                            <li v-for="(error, i) in getErrors" :key="i">
                                {{ error.join(", ") }}
                            </li>
                        </ul>
                    </template>

                    <div class="mb-4">
                        <label for="nombreUpdate" class="label">
                            Nombre de la categoría
                        </label>

                        <input
                            id="nombreUpdate"
                            class="input-form"
                            type="text"
                            placeholder="Nombre de la categoría"
                            v-model="categoria.nombre"
                        />
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input
                                v-model="categoria.activo"
                                id="checked-checkbox-update"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label
                                for="checked-checkbox-update"
                                class="ml-2 text-sm font-medium text-gray-600"
                            >
                                Activo / No activo
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-2 rounded-b border-t border-gray-200 p-6"
                >
                    <button
                        data-modal-toggle="modal"
                        type="button"
                        class="btn-primary"
                        @click="sendForm"
                    >
                        Actualizar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
    data() {
        return {
            categoria: {
                nombre: "",
                url: "",
                activo: false,
            },
            errors: [],
            url: "",
        };
    },
    methods: {
        setDataModal(data, url) {
            this.categoria = data;
            this.categoria.activo = data.activo === 1;
            this.url = url;
            this.errors = [];
            this.mostrarModal();
        },
        closeModal() {
            this.openModal(false);
        },
        mostrarModal() {
            this.openModal(true);
        },
        openModal: _.debounce((isOpen) => {
            const modal = document.getElementById("modal");
            // console.log(isOpen);
            if (!modal) {
                return;
            }

            // modal.className = "";
            const body = document.body;
            // console.log(body);
            if (!isOpen) {
                body.classList.remove("overflow-hidden");
                modal.classList.remove(
                    ...["flex", "items-center", "justify-center"]
                );
                modal.classList.add("hidden");
                modal.removeAttribute("aria-modal");
                modal.removeAttribute("role");
                modal.setAttribute("aria-hidden", "true");
            } else {
                body.classList.add("overflow-hidden");
                modal.classList.remove(["hidden"]);
                modal.classList.add(
                    ...["flex", "items-center", "justify-center"]
                );
                modal.setAttribute("aria-modal", "true");
                modal.setAttribute("role", "dialog");
                modal.removeAttribute("aria-hidden");
                document.getElementById("nombreUpdate")?.focus();
            }
        }, 250),
        sendForm() {
            // console.log(this.categoria);
            axios
                .put(this.url, this.categoria)
                .then((response) => {
                    // console.log(response);
                    Swal.fire({
                        title: "¡Actualizado!",
                        text: "Los datos han sido actualizados correctamente",
                        icon: "success",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn-primary",
                        },
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch(({ response }) => {
                    // console.log(response);
                    // console.log(response.data.errors);
                    this.errors = response.data.errors;
                    Swal.fire({
                        title: "¡Error!",
                        html: `<p>${response.data.message}</p>`,
                        icon: "error",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn-primary",
                        },
                    });
                });
        },
    },
    computed: {
        getErrors() {
            return this.errors;
        },
    },
    mounted() {
        // console.log("modal mounted");
        // console.log(this.url);

        const modal = document.getElementById("modal");
        modal.addEventListener("click", (e) => {
            if (document.getElementById("contentModal").contains(e.target)) {
                // alert("Clicked in Box");
            } else {
                // alert("Clicked outside Box");
                this.closeModal();
            }
        });
    },
};
</script>
