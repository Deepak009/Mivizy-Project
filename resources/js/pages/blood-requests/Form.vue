<template>
    <v-card>
		<div class="ma-5">
			<h3 class="pt-5">User Details:</h3>
			<v-row>
				<v-col>
					<v-list>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2"> ID:</span>
							<span class="text--secondary">{{ formData.user.id }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2"> Email:</span>
							<span class="text--secondary">{{ formData.user.email }}</span>
						</v-list-item>
					</v-list>
				</v-col>
				<v-col>
					<v-list>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2"> Name:</span>
							<span class="text--secondary">{{ formData.user.name }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2"> Phone Number:</span>
							<span class="text--secondary">{{ formData.user.phone_number }}</span>
						</v-list-item>
					</v-list>
				</v-col>
			</v-row>
			<v-divider></v-divider>
			<h3 class="mt-5">Patient Details:</h3>
			<v-row>
				<v-col>
					<v-list>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">Patient Name:</span>
							<span class="text--secondary">{{ formData.patient_name }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">Hospital name:</span>
							<span class="text--secondary">{{ formData.hospital_name }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">Number of unit:</span>
							<span class="text--secondary">{{ formData.number_of_unit }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">Address:</span>
							<span class="text--secondary">{{ formData.address }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">Pincode:</span>
							<span class="text--secondary">{{ formData.pincode }}</span>
						</v-list-item>
					</v-list>
				</v-col>
				<v-col>
					<v-list>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">Patient Age:</span>
							<span class="text--secondary">{{ formData.patient_age }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">Blood group:</span>
							<span class="text--secondary">{{ formData.blood_group }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">Mobile number:</span>
							<span class="text--secondary">{{ formData.mobile_number }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">state:</span>
							<span class="text--secondary">{{ formData.state }}</span>
						</v-list-item>
						<v-list-item
							dense
							class="px-0 mb-n2"
						>
							<span class="font-weight-medium text-no-wrap me-2">purpose:</span>
							<span class="text--secondary">{{ formData.purpose }}</span>
						</v-list-item>
					</v-list>
				</v-col>
			</v-row>
		</div>
        <v-card-text>
            <v-form ref="form" v-model="valid">
				<v-row>
					<v-col cols="12">
						<v-textarea
						outlined
						v-model="formData.note"
						label="Tuesday"
						></v-textarea>
					</v-col>
				</v-row>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="default" text :to="{name: 'blood-requests.list'}">
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
    name: 'BloodRequestForm',
    data: () => ({
        valid: false,
		blood_groups: [],
        formData: {
            id: null,
			user: {
				id: null,
				name: '',
				country_code: '',
				eamil: '',
				phone_number: '',
			},
            patient_name: '',
			patient_age: '',
			hospital_name: '',
			blood_group: '',
			number_of_unit: '',
			mobile_number: '',
			address: '',
			state: '',
			pincode: '',
			purpose: '',
			note: '',
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
        store.set("app/pageTitle", "Blood Request Details");
        if(this.$route.params.id) this.loadData();
		this.getBloodGroups();
    },
    methods: {
		getBloodGroups() {
			this.$store.dispatch("bloodRequest/getBloodGroups")
				.then(response => {
					this.blood_groups = response.data.blood_groups;
				})
		},
        loadData() {
            store
                .dispatch("bloodRequest/get", this.$route.params.id)
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
                    .dispatch(`bloodRequest/${action}`, this.formData)
                    .then(response => {
                        store.dispatch("app/success", `Successfully ${this.formData.id ? "Updated" : "Created"}`);
                        this.$router.push({ name: "blood-requests.list" });
                    })
                    .catch(err => {
						this.loading = false;
						const { message } = err.response.data || `Failed to ${this.formData.id ? 'update' : 'create'} Blood request`;
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
