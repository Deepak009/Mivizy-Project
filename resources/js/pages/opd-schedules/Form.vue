<template>
    <v-card>
        <v-card-text>
            <v-form ref="form" v-model="valid">
				<v-row>
					<v-col cols="6">
						<v-select
							v-model="formData.opd_category_id"
							:rules="required"
							:items="opd_categories"
							item-text="name"
							item-value="id"
							label="OPD Category *"
							outlined
						></v-select>
					</v-col>
					<v-col cols="6">
						<v-text-field
							v-model="formData.doctor_name"
							:rules="required"
							label="Doctor name *"
							required
							outlined
						></v-text-field>
					</v-col>
					<v-col cols="6">
						<v-text-field
							v-model="formData.doctor_qualifications"
							label="Doctor qualifications"
							outlined
						></v-text-field>
					</v-col>
					<v-col cols="6">
						<v-text-field
							v-model="formData.contact_number_1"
							label="Contact number 1"
							outlined
						></v-text-field>
					</v-col>
					<v-col cols="6">
						<v-text-field
							v-model="formData.contact_number_2"
							label="Contact number 2"
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
							v-model="formData.hospital_name"
							label="Hospital name"
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
				<v-row>
					<v-col cols="12" class="text-center">
						<h2 class="mb-2">Schedules</h2>
						<v-divider></v-divider>
					</v-col>
				</v-row>
				<v-row>
					<v-col cols="3">
						<v-checkbox
						value="sun"
						v-model="formData.schedules.days"
						label="Sunday available"
						></v-checkbox>
					</v-col>
					<v-col cols="9">
						<v-textarea
						outlined
						v-model="formData.schedules.slots.sun"
						label="Sunday"
						v-show="isSlotAvailable('sun')"
						></v-textarea>
					</v-col>
					<v-col cols="3">
						<v-checkbox
						value="mon"
						v-model="formData.schedules.days"
						label="Monday available"
						></v-checkbox>
					</v-col>
					<v-col cols="9">
						<v-textarea
						outlined
						v-model="formData.schedules.slots.mon"
						label="Monday"
						v-show="isSlotAvailable('mon')"
						></v-textarea>
					</v-col>
					<v-col cols="3">
						<v-checkbox
						value="tue"
						v-model="formData.schedules.days"
						label="Tuesday available"
						></v-checkbox>
					</v-col>
					<v-col cols="9">
						<v-textarea
						outlined
						v-model="formData.schedules.slots.tue"
						label="Tuesday"
						v-show="isSlotAvailable('tue')"
						></v-textarea>
					</v-col>
					<v-col cols="3">
						<v-checkbox
						value="wed"
						v-model="formData.schedules.days"
						label="Wednesday available"
						></v-checkbox>
					</v-col>
					<v-col cols="9">
						<v-textarea
						outlined
						v-model="formData.schedules.slots.wed"
						label="Wednesday"
						v-show="isSlotAvailable('wed')"
						></v-textarea>
					</v-col>
					<v-col cols="3">
						<v-checkbox
						value="thu"
						v-model="formData.schedules.days"
						label="Thursday available"
						></v-checkbox>
					</v-col>
					<v-col cols="9">
						<v-textarea
						outlined
						v-model="formData.schedules.slots.thu"
						label="Thursday"
						v-show="isSlotAvailable('thu')"
						></v-textarea>
					</v-col>
					<v-col cols="3">
						<v-checkbox
						value="fri"
						v-model="formData.schedules.days"
						label="Friday available"
						></v-checkbox>
					</v-col>
					<v-col cols="9">
						<v-textarea
						outlined
						v-model="formData.schedules.slots.fri"
						label="Friday"
						v-show="isSlotAvailable('fri')"
						></v-textarea>
					</v-col>
					<v-col cols="3">
						<v-checkbox
						value="sat"
						v-model="formData.schedules.days"
						label="Saturday available"
						></v-checkbox>
					</v-col>
					<v-col cols="9">
						<v-textarea
						outlined
						v-model="formData.schedules.slots.sat"
						label="Saturday"
						v-show="isSlotAvailable('sat')"
						></v-textarea>
					</v-col>
				</v-row>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="default" text :to="{name: 'opd-schedules.list'}">
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
    name: 'OPDScheduleForm',
    data: () => ({
        valid: false,
		opd_categories: [],
        formData: {
            id: null,
			opd_category_id: null,
			doctor_name: '',
			doctor_qualifications: '',
			contact_number_1: '',
			contact_number_2: '',
			address: '',
			state: '',
			hospital_name: '',
			pincode: '',
			gender: '',
			schedules: {
				days:[],
				slots: {
					'sun': '',
					'mon': '',
					'tue': '',
					'wed': '',
					'thu': '',
					'fri': '',
					'sat': '',
				}
			}
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
        store.set("app/pageTitle", "OPD Schedule Details");
        if(this.$route.params.id) this.loadData();
		this.getOPDCategories();
    },
    methods: {
		isSlotAvailable(day){
			return this.formData.schedules.days.includes(day);
		},
		getOPDCategories() {
			this.$store.dispatch("OPDSchedule/getOPDCategories")
				.then(response => {
					this.opd_categories = response.data.opd_categories;
				})
		},
        loadData() {
            store
                .dispatch("OPDSchedule/get", this.$route.params.id)
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
                    .dispatch(`OPDSchedule/${action}`, this.formData)
                    .then(response => {
                        store.dispatch("app/success", `Successfully ${this.formData.id ? "Updated" : "Created"}`);
                        this.$router.push({ name: "opd-schedules.list" });
                    })
                    .catch(err => {
						this.loading = false;
						const { message } = err.response.data || `Failed to ${this.formData.id ? 'update' : 'create'} OPD Schedule`;
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
