<template>
    <div>
        <v-simple-table>
            <template v-slot:default>
                <thead>
                    <tr>
                        <th
                            v-for="(slot, j) in slots"
                            :key="`slot-${index}-${j}`"
                            class="text-left"
                        >
                            {{ slot }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td
                            v-for="(slot, j) in slots"
                            :key="`slot-details-${index}-${j}`"
                        >
                            <v-list three-line>
                                <template
                                    v-for="(item, foodIndex) in getItemsForSlot(
                                        j
                                    )"
                                >
                                    <v-list-item
                                        :key="`food-${index}-${j}-${foodIndex}`"
                                    >
                                        <v-list-item-avatar>
                                            <v-img
                                                alt="Not Found"
                                                :src="getImageUrl(item)"
                                            ></v-img>
                                        </v-list-item-avatar>

                                        <v-list-item-content>
                                            <v-list-item-title
                                                v-text="item.food.name"
                                            ></v-list-item-title>
                                            <v-list-item-subtitle
                                                v-text="item.description"
                                            ></v-list-item-subtitle>
                                        </v-list-item-content>
                                        <v-list-item-action>
                                            <v-btn @click="editItem(item)" icon>
                                                <v-icon color="grey lighten-1"
                                                    >mdi-pencil</v-icon
                                                >
                                            </v-btn>
                                            <v-btn
                                                @click="removeItem(item)"
                                                icon
                                            >
                                                <v-icon color="grey lighten-1"
                                                    >mdi-delete</v-icon
                                                >
                                            </v-btn>
                                        </v-list-item-action>
                                    </v-list-item>
                                    <v-divider
                                        :key="
                                            `divider-${index}-${j}-${foodIndex}`
                                        "
                                        inset
                                    ></v-divider>
                                </template>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            <v-btn
                                                @click="addItem(j)"
                                                color="primary"
                                            >
                                                <v-icon color="white"
                                                    >mdi-plus-circle</v-icon
                                                >
                                                Add
                                            </v-btn>
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>
        <AddItemDialog
            v-if="showModal"
            @save="saveItem"
            @close="showModal = false"
            :item="selected"
        />
    </div>
</template>
<script>
import AddItemDialog from "./AddItemDialog";
import { sync } from "vuex-pathify";
export default {
    name: "DietChartTable",
    components: { AddItemDialog },
    props: {
        index: {},
        day: {}
    },
    computed: {
        chart: sync("diet/chart"),
        selectedItemIndex() {
            return this.chart.diet_chart_items.findIndex(i => {
                return (
                    i.day_of_week == this.selected.day_of_week &&
                    i.slot == this.selected.slot &&
                    i.food.id == this.selected.food.id
                );
            });
        }
    },
    data: () => ({
        slots: ["Breakfast", "Lunch", "Evening", "Dinner"],
        showModal: false,
        selected: {}
    }),
    methods: {
        getItemsForSlot(slot) {
            return (
                _.uniqBy(
                    this.chart.diet_chart_items.filter(
                        i => i.day_of_week == this.index && i.slot == slot
                    ),
                    "food.id"
                ) || []
            );
        },
        getImageUrl(item) {
            return (
                item.food.image?.url ||
                `${window.location.origin}/images/food-place-holder.jpeg`
            );
        },
        addItem(slotIndex) {
            this.selected = {
                day_of_week: this.index,
                day_of_week_label: this.day,
                slot: slotIndex,
                slot_label: this.slots[slotIndex],
                food: {},
                description: "",
                id: null
            };
            this.showModal = true;
        },
        saveItem(selected) {
            let item = {
                diet_chart_id: this.chart.id,
                slot: selected.slot,
                day_of_week: selected.day_of_week,
                food: selected.food,
                description: selected.description,
                id: selected.id,
                food_id: selected.food.id
            };
            let chart = _.cloneDeep(this.chart);
            if (this.selected.edit) {
                chart.diet_chart_items.splice(this.selectedItemIndex, 1, item);
            } else chart.diet_chart_items.push(item);

            this.chart = chart;
            this.showModal = false;

            if (this.chart.id) store.dispatch("diet/updateChartItem", item);
        },
        editItem(item) {
            item = _.cloneDeep(item);
            item.edit = true;
            this.selected = item;
            this.showModal = true;
        },
        removeItem(item) {
            this.selected = item;
            if (
                confirm(
                    `Are you Sure you want to delete ${item.food.name} from diet ?`
                )
            ) {
                let chart = _.cloneDeep(this.chart);
                chart.diet_chart_items.splice(this.selectedItemIndex, 1);
                this.chart = chart;

                if (item.id) store.dispatch("diet/deleteChartItem", item);
            }
        }
    }
};
</script>
