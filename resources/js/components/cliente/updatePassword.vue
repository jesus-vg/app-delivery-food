<template>
    <div class="mb-4">
        <label for="password" class="label">Tu contraseña</label>
        <input
            type="password"
            name="password"
            id="password"
            class="input-form"
            v-model="user.password"
        />
    </div>
    <div class="mb-4">
        <label for="confirmedPassword" class="label">
            Confirma tu contraseña
        </label>
        <input
            type="password"
            name="confirmedPassword"
            id="confirmedPassword"
            class="input-form"
            v-model="user.confirmedPassword"
        />
    </div>
    <p class="text-sm text-red-500" v-if="error !== ''">{{ error }}</p>
    <p class="text-sm text-red-500" v-if="oldError !== ''">
        {{ oldError }}
    </p>
</template>

<script>
export default {
    props: {
        oldError: {
            type: String,
        },
    },
    data() {
        return {
            user: {
                password: "",
                confirmedPassword: "",
            },
            error: "",
        };
    },
    methods: {
        validaPassword() {
            if (this.user.password !== this.user.confirmedPassword) {
                this.error =
                    "Las contraseñas no coniciden, por favor verifique";
            } else {
                this.error = "";
            }
        },
    },
    watch: {
        "user.password": ["validaPassword"],
        "user.confirmedPassword": ["validaPassword"],
    },
};
</script>
