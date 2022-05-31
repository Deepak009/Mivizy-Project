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
        </v-data-table>
    </v-card>
</template>
<script>
import moment from "moment";

export default {
    name: "CustomerList",
    data() {
        return {
            totalItems: 0,
            items: [],
            loading: false,
            options: {},
            keyword: "",
            headers: [
                { text: "External App ID", value: "external_app_id" },
                { text: "Name", value: "name" },
                { text: "Email", value: "email" },
                { text: "Phone Number", value: "phone_number" },
                { text: "Date of Birth", value: "date_of_birth" },
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
        store.set("app/pageTitle", "Customer List");
        this.getDataFromApi();
    },
    methods: {
        getDataFromApi() {
            console.log(this.options);
            this.loading = true;
            this.$store
                .dispatch("customer/getCustomers", {
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
