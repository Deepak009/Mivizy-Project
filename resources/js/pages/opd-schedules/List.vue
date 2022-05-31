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
				v-model="opd_category_id"
				:items="opd_categories"
				item-text="name"
				item-value="id"
				label="OPD Category"
				outlined
                clearable
				hide-details
			></v-select>
			<v-spacer></v-spacer>
			<v-btn :to="{ name: 'opd-schedules.create' }" color="primary">
                <v-icon color="white">
                    mdi-plus-circle
                </v-icon>
                 Add OPD schedule
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
                        name: 'opd-schedules.view',
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
                <v-btn
                   @click="deleteOpdSchedule(item)"
                    title="delete"
                    elevation="2"
                    icon
                >
                    <v-icon color="primary darken-2">
                        mdi-delete
                    </v-icon>
                </v-btn>
            </template>
        </v-data-table>
        <confirmationDelete v-if="showModal"
            @deleteItem="deleteItem"
            @close="showModal = false"/>
    </v-card>
</template>
<script>
import moment from "moment";
import confirmationDelete from './confirmation-delete.vue'

export default {
    name: "OPDScheduleList",
    components: {
        confirmationDelete
    },
    data() {
        return {
            totalItems: 0,
            items: [],
            loading: false,
            options: {},
            keyword: "",
			opd_category_id: null,
            headers: [
                { text: "OPD category", value: "o_p_d_category.name", sortable:false },
                { text: "Doctor name", value: "doctor_name" },
                // { text: "Doctor qualifications", value: "doctor_qualifications" },
                { text: "Contact number 1", value: "contact_number_1" },
                { text: "Contact number 2", value: "contact_number_2" },
                { text: "Email", value: "email" },
                { text: "Address", value: "address" },
                // { text: "State", value: "state" },
                { text: "Hospital name", value: "hospital_name" },
                { text: "Pincode", value: "pincode" },
                { text: "Action", value: "id", filterable: false, align: 'center' }
            ],
            moment,
			opd_categories:[],
            showModal: false,
            item: {},
        };
    },
    watch: {
        options: {
            handler() {
                this.getDataFromApi();
            },
            deep: true
        },
		opd_category_id: {
            handler() {
                this.getDataFromApi();
            },
            deep: true
        }
    },
    mounted() {
        store.set("app/pageTitle", "OPD schedule List");
        this.getDataFromApi();
		this.getOPDCategories();
    },
    methods: {
		getOPDCategories() {
			this.$store.dispatch("OPDSchedule/getOPDCategories")
				.then(response => {
					this.opd_categories = response.data.opd_categories;
				})
		},
        getDataFromApi() {
            console.log(this.options);
            this.loading = true;
            this.$store
                .dispatch("OPDSchedule/index", {
                    ...this.options,
                    search: this.keyword,
					opd_category_id: this.opd_category_id
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
        }, 1000),
        deleteOpdSchedule(item) {
            this.showModal = true
            this.item = item            
        },
        deleteItem() {
            this.$store
                    .dispatch(`OPDSchedule/delete`, this.item)
                    .then(response => {
                        this.$store.dispatch("app/success", `Successfully deleted.`);
                        this.getDataFromApi();
                    })
                    .catch(err => {
                        this.loading = false;
                        let errors = Object.values(err.response.data.errors)
                        this.$store.dispatch(
                            "app/error",
                            `Failed to delete opd schedule.`
                        );
                    });
            this.showModal = false
        }
    }
};
</script>
