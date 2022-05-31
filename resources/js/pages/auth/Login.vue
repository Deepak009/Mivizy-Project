<template>
    <empty-layout>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar color="primary">
                    <v-toolbar-title>Login</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                    <v-form @submit.prevent="login">
                        <v-text-field
                            prepend-icon="person"
                            name="login"
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
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text :to="{name: 'forgot-password'}">Forgot Password?</v-btn>
                    <v-btn :disabled="!isValid" @click="login" color="primary">Login</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </empty-layout>
</template>
<script>
export default {
    name: "Login",
    data() {
        return {
            payload: {
                email: '',
                password: ''
            }
        }
    },
    computed: {
        isValid() {
            return this.payload.password && this.payload.email
        }
    },
    methods: {
        login() {
            
            if(this.isValid)
            this.$store.dispatch('user/login', this.payload)
                .then(response => {
                    this.$store.commit('user/user', response.data)
                    this.$router.push({name: "dashboard"})
                    this.$store.dispatch('app/success', 'Successfully Logged In!')
                })
                .catch(err => {
                    this.$store.dispatch('app/error', 'Invalid Credentials!')
                })
        }
    }
};
</script>
