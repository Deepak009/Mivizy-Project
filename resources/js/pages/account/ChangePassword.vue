<template>
    <v-row>
        <v-col cols="6">
            <v-card>
                <v-card-title>Change Password</v-card-title>
                <v-card-text>
                    <v-form ref="form" @submit.prevent="changePassword">
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
                    <v-btn
                        :disabled="!isValid"
                        @click="changePassword"
                        color="primary"
                        >Update</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>
<script>
export default {
    name: "ChangePassword",
    data: () => ({
        payload: {
            password: "",
            password_confirmation: ""
        }
    }),
    computed: {
        isValid() {
            return (
                this.payload.password &&
                this.payload.password_confirmation == this.payload.password
            );
        }
    },
    methods: {
        changePassword() {
            if (this.isValid) {
                this.payload.token = this.$route.query.token;
                this.$store
                    .dispatch("user/updatePassword", this.payload)
                    .then(response => {
                        this.$refs.form.reset()
                        this.$store.dispatch(
                            "app/success",
                            "Password updated successfully!"
                        );
                    })
                    .catch(err => {
                        this.$store.dispatch(
                            "app/error",
                            "Failed to update Password!"
                        );
                    });
            }
        }
    }
};
</script>
