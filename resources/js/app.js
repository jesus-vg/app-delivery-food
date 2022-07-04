import "./bootstrap";

import Alpine from "alpinejs";
import { createApp } from "vue";

window.Alpine = Alpine;

Alpine.start();

window.API_KEY_LEAFLET_ESRI =
    "AAPK54c38450a1cb4847b31fb4c08d1ca8b5mq8DWiqnDiUMtZKD4e6j_nT3DoFjdoPnQardvbr4md3WqSrFoenYR4FbBGvh1_LW"; // API KEY LEAFLET

const app = createApp({});

// Register global components.
app.component(
    "buscar-direccion",
    require("./components/shared/BuscarDireccion.vue").default
);
app.component("v-select", require("./components/shared/vSelect.vue").default);
app.component(
    "eliminar-elemento",
    require("./components/shared/EliminarElemento.vue").default
);
app.component("modal", require("./components/shared/Modal.vue").default);
app.component(
    "editar-elemento",
    require("./components/shared/Editar.vue").default
);

// mount the app
app.mount(".app");
