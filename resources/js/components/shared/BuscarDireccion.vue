<template>
    <v-select
        :options="options"
        :filterable="false"
        placeholder="Ej. Calle Azcapotzalco, Jerusalén, Tlapa de Comonfort, Guerrero, México"
        v-model="selected"
        :reduce="(option) => [option.x, option.y].toString()"
        label="label"
        @search="onSearch"
    >
        <div class="spinner" v-show="spinner">Loadsdfa</div>
        <template #search="{ attributes, events }" class="input-form">
            <input
                class="vs__search"
                autocomplete="off"
                v-bind="attributes"
                v-on="events"
            />
        </template>
        <template v-slot:no-options="{ search, searching }">
            <template v-if="searching">
                <span style="opacity: 0.5">
                    No hay direcciones para: <em> {{ search }} </em>.
                </span>
            </template>
            <em v-else style="opacity: 0.5">
                Busca la derección del establecimiento
            </em>
        </template>
        <template v-slot:option="option">
            <div class="whitespace-pre-wrap">
                {{ option.label }}
            </div>
        </template>
    </v-select>

    <p class="mb-3 text-center mt-5 text-xs text-gray-600">
        El asistente colocará la dirección aproximada en el mapa, arrastra el
        pin para colocar la ubicación exacta.
    </p>

    <div
        id="mapa"
        class="z-0 mb-2 h-56 w-full rounded-lg border border-gray-300"
    ></div>

    <input type="hidden" name="latitud" :value="lat" />
    <input type="hidden" name="longitud" :value="lng" />
</template>

<script>
// otra ayuda para la busqueda https://codepen.io/sagalbot/pen/POMeOX
//  para mas info ver vue-select en https://vue-select.org/api/slots.html#selected-option-container
import vSelect from "vue-select";

export default {
    components: {
        "v-select": vSelect,
    },
    props: {
        oldlat: {
            type: Number,
        },
        oldlng: {
            type: Number,
        },
    },
    data() {
        return {
            provider: null,
            options: [],
            selected: null,
            mapa: null,
            marker: null,
            geocodeService: null,
            lat: this.oldlat || 20.666332695977,
            lng: this.oldlng || -103.392177745699,
            zoom: 16,
        };
    },
    methods: {
        onload() {
            // EsriProvider() hace mejor las busquedas a diferencia de OpenStreetMapProvider()
            // https://smeijer.github.io/leaflet-geosearch/providers/esri
            this.provider = new GeoSearch.EsriProvider();
            this.mapa = L.map("mapa").setView([this.lat, this.lng], this.zoom);
            // L.esri.basemapLayer("Streets")

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(this.mapa);

            // agregar el pin
            this.marker = new L.marker([this.lat, this.lng], {
                draggable: true,
                autoPan: true,
            }).addTo(this.mapa);

            // Geocode service
            this.geocodeService = L.esri.Geocoding.geocodeService({
                apikey: window.API_KEY_LEAFLET_ESRI,
            });

            // agregar el evento al soltar el pin
            this.marker.on("moveend", (e) => {
                const marker = e.target;

                const { lat, lng } = marker.getLatLng();
                this.lat = lat;
                this.lng = lng;

                // Obtener la dirección
                this.getDireccion(lat, lng);
            });
        },
        getDireccion(lat, lng) {
            this.mapa.panTo([lat, lng]);

            this.geocodeService
                .reverse()
                .latlng([lat, lng], this.zoom)
                .run((error, result) => {
                    if (error) {
                        console.log(error);
                    } else {
                        // console.log(result);
                        const { Address, Neighborhood, LongLabel, City } =
                            result.address;

                        // actualizamos la ubicacion del mapa
                        this.mapa.setView([lat, lng], this.zoom);

                        // movemos el pin al lugar de la direccion
                        this.marker.setLatLng([lat, lng]);

                        // agregamos el texto de la direccion en el popup del pin
                        this.marker
                            .bindPopup(
                                `<p class="text-xs text-gray-600">${LongLabel}</p>`
                            )
                            .openPopup();

                        document.getElementById("direccion").value =
                            Address || "";
                        document.getElementById("colonia").value =
                            Neighborhood || City || "";
                    }
                });
        },
        onSearch(search, loading) {
            if (search.length > 8) {
                loading(true);
                this.search(loading, search, this, this.provider);
            }
        },
        search: _.debounce((loading, search, vm, provider) => {
            provider
                .search({
                    query: search || "",
                })
                .then((res) => {
                    // console.log(search);
                    // console.log(res);
                    vm.options = res;
                    loading(false);
                });
        }, 2_000),
    },
    watch: {
        selected(val) {
            // console.log(val);
            if (val) {
                let [lng, lat] = val.split(",");

                this.lat = Number(lat);
                this.lng = Number(lng);

                // Obtener la dirección
                this.getDireccion(lat, lng);
            }
        },
    },
    mounted() {
        this.onload();
    },
};
</script>
