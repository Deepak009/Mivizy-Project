<template>
    <empty-layout>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar color="primary">
                    <v-toolbar-title>Reset Password</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                    <v-form @submit.prevent="reset">
                        <v-text-field
                            prepend-icon="person"
                            label="Email"
                            type="email"
                            v-model="payload.email"
                        ></v-text-field>
                        <v-text-field
                            id="password"
                            prepend-icon="lock"
                            name="password"
                            label="Password"
                            type="password"
                            v-model="payload.password"
                        ></v-text-field>
                        <v-text-field
                            id="password"
                            prepend-icon="lock"
                            name="password"
                            label="Confirm Password"
                            type="password"
                            v-model="payload.password_confirmation"
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text :to="{ name: 'login' }">Login</v-btn>
                    <v-btn :disabled="!isValid" @click="reset" color="primary"
                        >Reset</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-flex>
    </empty-layout>
</template>
<script>
export default {
    name: "ResetPassword",
    data() {
        return {
            payload: {
                token: '',
                email: "",
                password_confirmation: "",
                password: ""
            }
        };
    },
    computed: {
        isValid() {
            return (
                this.payload.email &&
                this.payload.password &&
                this.payload.password_confirmation == this.payload.password
            );
        }
    },
    methods: {
        reset() {
            if (this.isValid) {
                this.payload.token = this.$route.query.token;
                this.$store
                    .dispatch("user/resetPassword", this.payload)
                    .then(response => {
                        this.$router.push({ name: "login" });
                        this.$store.dispatch(
                            "app/success",
                            "Reset Successfully! Please Login"
                        );
                    })
                    .catch(err => {
                        this.$store.dispatch(
                            "app/error",
                            "Failed to Reset Password!"
                        );
                    });
            }
        }
    }
};
</script>
