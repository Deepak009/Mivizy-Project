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
            <template v-slot:item.diet_chart="{ item }">
                <v-icon v-if="item.diet_chart" color="green darken-2">
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
                        name: 'diet-question-feedbacks.view',
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
    name: "DietQuestionFeedbackList",
    data() {
        return {
            totalItems: 0,
            items: [],
            loading: false,
            options: {},
            keyword: "",
            headers: [
                {
                    text: "User",
                    align: "start",
                    value: "user.name"
                },
                { text: "Chart created", value: "diet_chart" },
                { text: "Created At", value: "created_at" },
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
        store.set("app/pageTitle", "Diet Question Feedback List");
        this.getDataFromApi();
    },
    methods: {
        getDataFromApi() {
            this.loading = true;
            this.$store
                .dispatch("diet/getQuestionFeedbackList", {
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
