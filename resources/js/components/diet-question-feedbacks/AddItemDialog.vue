<template>
    <v-dialog
        :value="true"
        transition="dialog-bottom-transition"
        max-width="600"
    >
        <v-card>
            <v-toolbar color="primary">
                {{ `Select Food for ${local.day_of_week_label } ${local.slot_label}` }}
            </v-toolbar>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-autocomplete
                                :items="visibleFoods"
                                label="Food"
                                outlined
                                item-text="name"
                                return-object
                                v-model="local.food"
                            ></v-autocomplete>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                name="input-7-4"
                                label="Description"
                                v-model="local.description"
                            ></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions class="justify-end">
                <v-btn text @click="$emit('close')">Close</v-btn>
                <v-btn color="primary" text @click="save">
                    {{ local.id ? 'Update' : 'Add' }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import { get } from "vuex-pathify";

export default {
    name: "AddItemDialog",
    props: {
        item: {},
    },
    data: () => ({
        local: {},
    }),
    computed: {
        foods: get("diet/foods"),
        visibleFoods() {
            return this.foods[this.item.slot];
        },
    },
    mounted() {
        this.local = _.cloneDeep(this.item);
    },
    methods: {
        save() {
            this.$emit("save", this.local);
        }
    }
};
</script>
