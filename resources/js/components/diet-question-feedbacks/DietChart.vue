<template>
    <v-card>
        <v-card-title>
            <v-row>
                <v-col>Diet Chart</v-col>
                <v-col>
                    <v-select
                        outlined
                        v-model="template.selected"
                        @change="loadTemplate"
                        :items="templates"
                        label="Templates"
                        item-text="name"
                        return-object
                    ></v-select>
                </v-col>
            </v-row>
        </v-card-title>
        <v-card-text>
            <DietChartForm></DietChartForm>
            <v-row>
                <v-col>
                    <v-card>
                        <v-tabs v-model="tab" grow background-color="primary">
                            <v-tab v-for="(day, i) in days" :key="`day-${i}`">
                                {{ day }}
                            </v-tab>
                        </v-tabs>

                        <v-tabs-items v-model="tab">
                            <v-tab-item
                                v-for="(day, i) in days"
                                :key="`day-details-${i}`"
                            >
                                <v-card flat>
                                    <v-card-text>
                                        <DietChartTable
                                            :key="`chart-${i}`"
                                            :index="i"
                                            :day="day"
                                        />
                                    </v-card-text>
                                </v-card>
                            </v-tab-item>
                        </v-tabs-items>
                    </v-card>
                </v-col>
            </v-row>
        </v-card-text>
        <v-card-actions class="justify-end">
            <v-btn left color="default" @click="template.showDialog = true">
                Save As Template
            </v-btn>
            <v-btn color="primary" @click="save">
                Save
            </v-btn>
        </v-card-actions>
        <v-dialog
            :value="true"
            v-if="template.showDialog"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Save as Template
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="template.name"
                                    outlined
                                    :error-messages="template.error"
                                    name="input-7-4"
                                    label="Template Name"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        @click="template.showDialog = false"
                        color="default"
                        text
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        :loading="template.saving"
                        color="primary"
                        @click="saveAsTemplate"
                    >
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>
<script>
import DietChartForm from "./DietChartForm.vue";
import { get, sync } from "vuex-pathify";

export default {
    name: "DietChart",
    components: { DietChartForm },
    data: () => ({
        tab: 0,
        days: [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ],
        showChart: false,
        template: {
            showDialog: false,
            name: "",
            saving: false,
            error: "",
            selected: {}
        }
    }),
    computed: {
        chart: sync("diet/chart"),
        templates: get("diet/templates")
    },
    mounted() {
        store.dispatch("diet/getAllFoods");
        store.dispatch("diet/getTemplates");
    },
    methods: {
        save() {
            store.dispatch("diet/saveChart");
        },
        saveAsTemplate() {
            this.template.saving = true;
            store
                .dispatch("diet/saveChartAsTemplate", this.template.name)
                .then(response => {
                    this.template.saving = false;
                    this.template.showDialog = false;
                    this.template.error = "";
                    store.dispatch("app/success", "Successfully Saved");
                })
                .catch(err => {
                    this.template.saving = false;
                    if (err.response.status == 422) {
                        this.template.error = "This name is already in use";
                    }
                });
        },
        loadTemplate() {
            let selected =  _.cloneDeep(this.template.selected);
            let chart = _.cloneDeep(this.chart);
            chart.remarks = selected.remarks
            chart.valid_from = selected.valid_from
            chart.valid_upto = selected.valid_upto
            chart.diet_chart_items = selected.diet_chart_template_items
            this.chart = chart
        }
    }
};
</script>
