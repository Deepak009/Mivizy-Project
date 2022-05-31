<template>
    <v-card>
        <v-data-table :headers="headers" :items="items">
            <template v-slot:item.image="{ item }">
                <v-img
                    lazy-src="https://picsum.photos/id/11/10/6"
                    max-height="150"
                    max-width="250"
                    :src="item.image.url"
                ></v-img>
            </template>
            <template v-slot:item.updated_at="{ item }">
                {{ moment(item.updated_at).format("DD-MM-YYYY H:m A") }}
            </template>
            <template v-slot:item.id="{ item }">
                <v-btn
                    :to="{
                        name: 'banner.edit',
                        params: { id: item.id }
                    }"
                    title="Edit"
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
    name: "BannerList",
    data() {
        return {
            items: [],
            headers: [
                { text: "Image", value: "image" },
                { text: "Order", value: "order" },
                { text: "Description", value: "description" },
                { text: "Updated At", value: "updated_at" },
                { text: "Action", value: "id", filterable: false }
            ],
            moment
        };
    },
    mounted() {
        store.set("app/pageTitle", "Banner List");
        this.getDataFromApi();
    },
    methods: {
        getDataFromApi() {
            this.$store
                .dispatch("banner/get")
                .then(response => {
                    this.items = response.data;
                })
                .catch(err => {});
        }
    }
};
</script>
