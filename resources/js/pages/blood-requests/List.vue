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
                        name: 'blood-requests.view',
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
    name: "BloodRequestList",
    data() {
        return {
            totalItems: 0,
            items: [],
            loading: false,
            options: {},
            keyword: "",
            headers: [
                { text: "User", value: "user.name" },
                { text: "Patient Name", value: "patient_name" },
                { text: "Blood Group", value: "blood_group" },
                { text: "No. of unit", value: "number_of_unit" },
                { text: "Purpose", value: "purpose" },
                { text: "Hospital", value: "hospital_name" },
                { text: "Mobile", value: "mobile_number" },
                { text: "State", value: "state" },
                { text: "Pincode", value: "pincode" },
                { text: "Note", value: "note" },
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
        }
    },
    mounted() {
        store.set("app/pageTitle", "Blood request List");
        this.getDataFromApi();
    },
    methods: {
        getDataFromApi() {
            console.log(this.options);
            this.loading = true;
            this.$store
                .dispatch("bloodRequest/index", {
                    ...this.options,
                    search: this.keyword
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
