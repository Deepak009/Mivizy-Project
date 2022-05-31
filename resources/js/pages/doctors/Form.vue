<template>
    <v-card>
]        <v-card-text>
            <v-form ref="form" v-model="valid">
                <v-select v-model="select" :items="items" :rules="[v => !!v || 'Item is required']"
                    label="Type of Doctor" required></v-select>


                <v-text-field label="Enter Doctor Name" required outlined></v-text-field>

                <v-select :items="departments" label="Department" required></v-select>

                <v-text-field label="Expertize" required outlined></v-text-field>

                <v-textarea clearable clear-icon="mdi-close-circle" label="Address" value="Enter Address Here">
                </v-textarea>

                <template>
                    <v-file-input accept="image/*" label="Select Photo"></v-file-input>
                </template>

                <v-text-field label="Qualification" required outlined></v-text-field>

                <v-text-field label="Experience" required outlined></v-text-field>

                <v-text-field v-model="user.phone_number" :rules="phoneRules" label="Phone Number" outlined required>
                </v-text-field>

                <v-text-field :rules="phoneRules" label="Alternate Number" outlined required>
                </v-text-field>

                <v-text-field label="Hospital Name" outlined required>
                </v-text-field>

                <v-select :items="private_constult_times" label="Private Consultation Time" required></v-select>


                <v-select :items="days" label="Weekly Off Day" required></v-select>




   <v-text-field type="text"  label="Average Consultation Time" 
   outlined
                    ></v-text-field>

                <v-text-field type="password" v-model="user.password" label="Password" :rules="passwordRules" outlined
                    required></v-text-field>

                <v-checkbox true-value="1" v-model="user.status" label="Is active?" required></v-checkbox>
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
    name: "UserForm",
    data: () => ({
        valid: false,
        user: {
            name: "",
            email: "",
            phone_number: "",
            password: "",
            status: false
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
        loading: false,

        items: ["Item 1", "Item 2", "Item 3", "Item 4"],
        departments: [
            "Department 1",
            "Department 2",
            "Department 3",
            "Department 4"
        ],
        private_constult_times: [
            "10AM TO 2PM",
            "2PM to 4PM",
            "4PM to 10PM",
            "10PM to 12AM"
        ],
        days: [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Friday',
            'Saturday',
            'Sunday'

        ]
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
            return [];
        }
    },
    mounted() {
        store.set("app/pageTitle", "Add New Doctor Form");
        if (this.$route.params.id) this.loadData();

        this.loadCategories();
    },
    methods: {
        loadCategories() {
            store
                .dispatch("user/getUserDetails", this.$route.params.id)
                .then(response => {
                    console.log(response.data);
                })
                .catch(err => {
                    store.dispatch("app/error", "Failed to load User Details");
                });
        },
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
                let action = !this.user.id ? "createDoctor" : "updateUser";
                this.loading = true;
                console.log(this.user);
                console.log(action);

                store
                    .dispatch(`doctor/${action}`, this.user)
                    .then(response => {
                        console.log(response);

                        store.dispatch(
                            "app/success",
                            `Successfully ${this.user.id ? "Updated" : "Created"
                            }`
                        );
                        this.$router.push({ name: "doctors.list" });
                        this.loading = false;
                    })
                    .catch(err => {
                        console.log(err.response);

                        this.loading = false;
                        let errors = Object.values(err.response.data.errors);
                        store.dispatch(
                            "app/error",
                            `Failed to ${this.user.id ? "update" : "create"
                            } User. ${errors[0]}`
                        );
                    });
            }
        }
    }
};
</script>
