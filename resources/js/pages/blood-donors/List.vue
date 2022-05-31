<template>
    <v-card>
        <v-card-title>
            <v-text-field
                v-model="keyword"
                append-icon="mdi-magnify"
                label="Search"
                outlined
                clearable
                @click:clear="search"
                @keyup="search"
                hide-details
            ></v-text-field>
            <v-spacer></v-spacer>
			<v-select
				v-model="blood_group"
				:items="blood_groups"
				item-text="name"
				item-value="id"
				label="Blood group"
				outlined
                clearable
				hide-details
			></v-select>
            <v-spacer></v-spacer>
			<v-btn :to="{ name: 'blood-donors.create' }" color="primary">
                <v-icon color="white">
                    mdi-plus-circle
                </v-icon>
                 Add Blood donor
            </v-btn>
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="items"
            :search="keyword"
            loading-text="Loading... Please wait"
            :options.sync="options"
            :server-items-length="totalItems"
            :loading="loading"
        >
            <template v-slot:item.id="{ item }">
                <v-btn
                    :to="{
                        name: 'blood-donors.view',
                        params: { id: item.id }
                    }"
                    title="view"
                    elevation="2"
                    icon
                >
                    <v-icon color="primary darken-2">
                        mdi-eye
                    </v-icon>
                </v-btn>
            </template>
        </v-data-table>
    </v-card>
</template>
<script>
import moment from "moment";

export default {
    name: "BloodDonorList",
    data() {
        return {
            totalItems: 0,
            items: [],
            loading: false,
            options: {},
			blood_group: null,
            keyword: "",
			blood_groups:[],
            headers: [
                { text: "Name", value: "name" },
                { text: "Gender", value: "gender" },
                { text: "DOB", value: "dob" },
                { text: "Blood Group", value: "blood_group" },
                { text: "Weight in kgs", value: "weight_in_kgs" },
                { text: "Email", value: "email" },
                { text: "Mobile", value: "mobile_number" },
                { text: "Address", value: "address" },
                { text: "State", value: "state" },
                { text: "Pincode", value: "pincode" },
                { text: "Action", value: "id", filterable: false }
            ],
            moment
        };
    },
    watch: {
        options: {
            handler() {
                this.getDataFromApi();
            },
            deep: true
        },
		blood_group: {
            handler() {
                this.getDataFromApi();
            },
            deep: true
        },
    },
    mounted() {
        store.set("app/pageTitle", "Blood donor List");
        this.getDataFromApi();
        this.getBloodGroups();
    },
    methods: {
		getBloodGroups() {
			this.$store.dispatch("bloodDonor/getBloodGroups")
				.then(response => {
					this.blood_groups = response.data.blood_groups;
				})
		},
        getDataFromApi() {
            this.loading = true;
            this.$store
                .dispatch("bloodDonor/index", {
                    ...this.options,
                    search: this.keyword,
					blood_group: this.blood_group
                })
                .then(response => {
                    this.items = response.data.data;
                    this.totalItems = response.data.total;
                    this.loading = false;
                })
                .catch(err => {});
        },
        search: _.debounce(function() {
            this.getDataFromApi();
        }, 1000)
    }
};
</script>
