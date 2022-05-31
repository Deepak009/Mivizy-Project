<template>
    <empty-layout>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar color="primary">
                    <v-toolbar-title>Forgot Password </v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                    <v-form @submit.prevent="send">
                        <v-text-field
                            prepend-icon="person"
                            name="login"
                            label="Email"
                            type="email"
                            v-model="payload.email"
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :disabled="!isValid" @click="send" color="primary">Send Reset Password Link</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </empty-layout>
</template>
<script>
export default {
    name: "ForgotPassword",
    data() {
        return {
            payload: {
                email: '',
            }
        }
    },
    computed: {
        isValid() {
            return this.payload.email
        }
    },
    methods: {
        send() {
            if(this.isValid)
            this.$store.dispatch('user/forgotPassword', this.payload)
                .then(response => {
                    this.$store.dispatch('app/success', 'Reset Password link has been sent!')
                })
                .catch(err => {
                    this.$store.dispatch('app/error', 'Failed to Reset Password Link')
                })
        }
    }
};
</script>
