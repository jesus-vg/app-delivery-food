<template>
    <v-select
        :options="options"
        label="nombre"
        placeholder="Elija una opción"
        v-model="selected"
        :reduce="(option) => option.id"
    >
        <template #search="{ attributes, events }" class="input-form">
            <input
                class="vs__search"
                autocomplete="off"
                :required="!selected"
                v-bind="attributes"
                v-on="events"
                :id="name"
            />
        </template>
        <template #no-options> No hay coincidencias </template>
    </v-select>
    <input type="hidden" :name="name" :value="selected" />
</template>

<script>
// soporte para vue3 se instaló vue-select@beta
// https://github.com/sagalbot/vue-select/issues/1597
// demo https://vue-select.org/guide/values.html#single-multiple
// mas documentacion...
// https://vue-select.org/api/events.html#search
// https://vue-select.org/guide/ajax.html#disabling-filtering
import vSelect from "vue-select";

export default {
    components: {
        "v-select": vSelect,
    },
    props: {
        data: {
            type: String,
            required: true,
        },
        value: {
            type: String,
            default: null,
        },
        name: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            selected: this.value === "" ? null : Number(this.value),
            options: JSON.parse(this.data), // 0: {id: 1, nombre: '0 - 500 USD'} 1: {id: 2, nombre: '500 - 1000 USD'}
        };
    },
    mounted() {
        console.log(this.options);
    },
};
</script>
