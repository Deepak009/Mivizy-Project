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
            <v-btn :to="{ name: 'dieticians.create' }" color="primary">
                <v-icon color="white">
                    mdi-plus-circle
                </v-icon>
                 Add Dietician
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
            <template v-slot:item.user.status="{ item }">
                <v-icon v-if="item.user.status == 1" color="green darken-2">
                    mdi-check-circle-outline
                </v-icon>
                <v-icon v-else color="red darken-2">
                    mdi-close-circle-outline
                </v-icon>
            </template>
            <template v-slot:item.created_at="{ item }">
                {{ moment(item.created_at).format("DD-MM-YYYY H:m A") }}
            </template>
            <template v-slot:item.id="{ item }">
                <v-btn
                    :to="{
                        name: 'dieticians.edit',
                        params: { id: item.id }
                    }"
                    title="edit"
                    elevation="2"
                    icon
                >
                    <v-icon color="primary darken-2">
                        mdi-pencil
                    </v-icon>
                </v-btn>
            </template>
        </v-data-table>
    </v-card>
</template>
<script>
import moment from "moment";

export default {
    name: "DieticiansList",
    data() {
        return {
            totalItems: 0,
            items: [],
            loading: false,
            options: {},
            keyword: "",
            headers: [
                {
                    text: "Name",
                    align: "start",
                    value: "user.name"
                },
                { text: "Email", value: "user.email" },
                { text: "Phone Number", value: "user.phone_number" },
                { text: "Degree", value: "degree" },
                { text: "Status", value: "user.status" },
                { text: "Created at", value: "created_at" },
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
        store.set("app/pageTitle", "Dietician List");
        this.getDataFromApi();
    },
    methods: {
        getDataFromApi() {
            this.loading = true;
            this.$store
                .dispatch("dietician/getDieticiansList", {
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
