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
            <v-btn :to="{ name: 'doctor.create' }" color="primary">
                <v-icon color="white">
                    mdi-plus-circle
                </v-icon>
                 Add Doctor
            </v-btn>
        </v-card-title>
        <v-data-table :headers="headers" :items="items"  >
            
            <template v-slot:item.updated_at="{ item }">
                {{ moment(item.updated_at).format("DD-MM-YYYY H:m A") }}
            </template>
            
        </v-data-table>
    </v-card>
</template>
<script>
import moment from "moment";

export default {
    name: "DoctorList",
    data() {
        return {
            items: [],
            headers: [
                { text: "Doctor Name", value: "name" },
                { text: "Image", value: "image" },
                { text: "Phone Number", value: "phone_number" },
                { text: "Action", value: "id", filterable: false }
            ],
            moment
        };
    },
    mounted() {
        store.set("app/pageTitle", "Doctors List");
        this.getDataFromApi();
    },
    methods: {
        getDataFromApi() {


            this.$store
                .dispatch("doctor/get")
                .then(response => {
                    console.log(response.data);
                    this.items = response.data;
                })
                .catch(err => { console.log(err); });
        },
        search: _.debounce(function() {
            this.getDataFromApi();
        }, 1000)
    }
};
</script>
