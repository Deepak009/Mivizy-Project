<template>
    <v-card>
        <v-card-text>
            <v-form ref="form" v-model="valid">
                <v-text-field
                    v-model="user.name"
                    :rules="nameRules"
                    label="Name"
                    required
                    outlined
                ></v-text-field>

                <v-text-field
                    v-model="user.email"
                    :rules="emailRules"
                    label="E-mail"
                    required
                    outlined
                ></v-text-field>

                <v-text-field
                    v-model="user.phone_number"
                    :rules="phoneRules"
                    label="Phone Number"
                    outlined
                    required
                ></v-text-field>

                <v-text-field
                    type="password"
                    v-model="user.password"
                    label="Password"
                    :rules="passwordRules"
                    outlined
                    required
                ></v-text-field>

                <v-checkbox
                    true-value="1"
                    v-model="user.status"
                    label="Is active?"
                    required
                ></v-checkbox>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn :to="{ name: 'users.list' }" color="default" text>
                Back
            </v-btn>
            <v-btn :disabled="!valid" :loading="loading" @click="save" color="primary">
                Save
            </v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    name: 'UserForm',
    data: () => ({
        valid: false,
        user: {
            id: null,
            name: '',
            email: '',
            phone_number: '',
            password: '',
            status: false,
        },
        nameRules: [v => !!v || "Name is required"],
        phoneRules: [
            v => !!v || "Phone Number required",
            v =>
                (v && v.length == 10 && !isNaN(v)) ||
                "Phone Number must be 10 digits"
        ],
        emailRules: [
            v => !!v || "E-mail is required",
            v => /.+@.+\..+/.test(v) || "E-mail must be valid"
        ],
        loading: false
    }),
    computed: {
        passwordRules() {
            if (!this.user.id) {
                return [
                    v => !!v || "Password is required",
                    v =>
                        (v && v.length >= 8) ||
                        "Password must be atleast  8 characters"
                ];
            }
            return []
        }
    },
    mounted() {
        store.set("app/pageTitle", "User Details");
        if(this.$route.params.id) this.loadData();
    },
    methods: {
        loadData() {
            store
                .dispatch("user/getUserDetails", this.$route.params.id)
                .then(response => {
                    this.user = response.data;
                })
                .catch(err => {
                    store.dispatch("app/error", "Failed to load User Details");
                });
        },
        save() {
            if (this.valid) {
                let action = !this.user.id ? 'createUser' : 'updateUser';
                this.loading = true
                store
                    .dispatch(`user/${action}`, this.user)
                    .then(response => {
                        store.dispatch("app/success", `Successfully ${this.user.id ? "Updated" : "Created"}`);
                        this.$router.push({ name: "users.list" });
                        console.log(response);
                    })
                    .catch(err => {
                        this.loading = false;
                        let errors = Object.values(err.response.data.errors)
                        store.dispatch(
                            "app/error",
                            `Failed to ${this.user.id ? 'update' : 'create'} User. ${errors[0]}`
                        );
                    });
            }
        },
    }
};
</script>
