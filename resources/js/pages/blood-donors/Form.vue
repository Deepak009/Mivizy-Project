<template>
    <v-card>
        <v-card-text>
            <v-form ref="form" v-model="valid">
				<v-row>
					<v-col cols="6">
						<v-text-field
							v-model="formData.name"
							:rules="required"
							label="Name *"
							required
							outlined
						></v-text-field>
					</v-col>
					<v-col cols="6">
						<v-select
							v-model="formData.gender"
							:items="genders"
							label="Gender"
							outlined
						></v-select>
					</v-col>
					<v-col cols="6">
						<v-menu
							ref="menu"
							:close-on-content-click="false"
							transition="scale-transition"
							offset-y
							min-width="auto"
						>
							<template v-slot:activator="{ on, attrs }">
								<v-text-field
									v-model="formData.dob"
									label="Birthday date"
									readonly
									outlined
									v-bind="attrs"
									v-on="on"
								></v-text-field>
							</template>
							<v-date-picker
								v-model="formData.dob"
								:max="(new Date(Date.now() - 1000 * 60 * 60 * 24 * 5840)).toISOString().substr(0, 10)"
								min="1950-01-01"
							></v-date-picker>
						</v-menu>
					</v-col>
					<v-col cols="6">
						<v-select
							v-model="formData.blood_group"
							:rules="required"
							:items="blood_groups"
							label="Blood Group *"
							outlined
						></v-select>
					</v-col>
					<v-col cols="6">
						<v-text-field
							v-model.number="formData.weight_in_kgs"
							label="Weight in kgs*"
							outlined
						></v-text-field>
					</v-col>
					<v-col cols="6">
						<v-text-field
							v-model="formData.email"
							label="Email"
							outlined
						></v-text-field>
					</v-col>
					<v-col cols="6">
						<v-text-field
							v-model="formData.mobile_number"
							:rules="required"
							label="Mobile *"
							required
							outlined
						></v-text-field>
					</v-col>
				</v-row>
				<v-row>
					<v-col>
						<v-text-field
							v-model="formData.address"
							label="Address"
							outlined
						></v-text-field>
					</v-col>
				</v-row>
				<v-row>
					<v-col cols="6">
						<v-text-field
							v-model="formData.state"
							label="State"
							outlined
						></v-text-field>
					</v-col>
					<v-col cols="6">
						<v-text-field
							v-model="formData.pincode"
							label="Pincode"
							outlined
						></v-text-field>
					</v-col>
				</v-row>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="default" text :to="{name: 'blood-donors.list'}">
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
    name: 'BloodDonorForm',
    data: () => ({
        valid: false,
		blood_groups: [],
        formData: {
            id: null,
            name: '',
			gender: '',
			dob: '',
			blood_group: '',
			weight_in_kgs: 0,
			email: '',
			mobile_number: '',
			address: '',
			state: '',
			pincode: '',
        },
        required: [v => !!v || "This field is required"],
        loading: false,
    }),
    computed: {
		genders(){
			return [
				'Male',
				'Female'
			]
		}
    },
    mounted() {
        store.set("app/pageTitle", "Blood Donor Details");
        if(this.$route.params.id) this.loadData();
		this.getBloodGroups();
    },
    methods: {
		getBloodGroups() {
			this.$store.dispatch("bloodDonor/getBloodGroups")
				.then(response => {
					this.blood_groups = response.data.blood_groups;
				})
		},
        loadData() {
            store
                .dispatch("bloodDonor/get", this.$route.params.id)
                .then(response => {
                    this.formData = response.data;
                })
                .catch(err => {
                    store.dispatch("app/error", "Failed to load Details");
                });
        },
        save() {
            if (this.valid) {
                let action = !this.formData.id ? 'create' : 'update';
                this.loading = true
                store
                    .dispatch(`bloodDonor/${action}`, this.formData)
                    .then(response => {
                        store.dispatch("app/success", `Successfully ${this.formData.id ? "Updated" : "Created"}`);
                        this.$router.push({ name: "blood-donors.list" });
                    })
                    .catch(err => {
                        this.loading = false;
						const { message } = err.response.data || `Failed to ${this.formData.id ? 'update' : 'create'} Blood donor`;
                        store.dispatch(
                            "app/error",
                            message
                        );
                    });
            }
        },
    }
};
</script>
