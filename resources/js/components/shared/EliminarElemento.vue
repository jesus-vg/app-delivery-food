<template>
    <button class="text-red-500 px-1" @click="eliminar">Eliminar</button>
</template>

<script>
import Swal from "sweetalert2";

export default {
    props: {
        url: {
            type: String,
            required: true,
        },
        message: {
            type: String,
            value: null,
        },
    },
    data() {
        return {
            mensaje:
                this.message ||
                "Estás a punto de eliminar un elemento de la base de datos<br>¿Deseas continuar?",
        };
    },
    methods: {
        eliminar() {
            Swal.fire({
                title: "¿Estás seguro?",
                html: this.mensaje,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "Cancelar",
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn-primary mr-2",
                    cancelButton: "btn-delete",
                },
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return axios
                        .delete(this.url)
                        .then(({ data }) => {
                            // console.log(data);
                            return data;
                        })
                        .catch(({ response }) => {
                            // console.log(response);
                            Swal.showValidationMessage(response.data.message);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    // console.log(result);
                    Swal.fire({
                        title: "Eliminado",
                        html: "El registro ha sido eliminado",
                        icon: "success",
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "btn-primary",
                        },
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        },
    },
};
</script>

<style></style>
