<template>
    <v-row>
        <v-col cols="12" md="6">
            <v-menu
                v-model="picker1"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="auto"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="valid_from"
                        label="Valid From"
                        readonly
                        outlined
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-date-picker
                    v-model="valid_from"
                    @input="picker1 = false"
                ></v-date-picker>
            </v-menu>
        </v-col>
        <v-col cols="12" md="6">
            <v-menu
                v-model="picker2"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="auto"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="valid_upto"
                        label="Valid Upto"
                        readonly
                        outlined
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-date-picker
                    v-model="valid_upto"
                    @input="picker2 = false"
                ></v-date-picker>
            </v-menu>
        </v-col>
        <v-col cols="12">
            <v-text-field outlined v-model="remarks" label="Remarks" required></v-text-field>
        </v-col>
    </v-row>
</template>
<script>
import { sync } from "vuex-pathify";

export default {
    name: "DietChartForm",
    data: () => ({
        picker1: false,
        picker2: false
    }),
    computed: {
        ...sync("diet/chart@", [
            'valid_from',
            'valid_upto',
            'remarks',
        ])
    },
    methods: {}
};
</script>
