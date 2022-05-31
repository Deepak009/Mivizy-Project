<template>
    <v-card>
        <v-card-text>
            <v-form ref="form" v-model="valid">
				<v-row>
					<v-col cols="12">
						<v-text-field
							v-model="food.name"
							:rules="required"
							label="Name *"
							required
							outlined
						></v-text-field>
					</v-col>
					<v-col cols="6">
						<v-select
							v-model="food.type"
							:items="food_types"
							:rules="required"
							label="Food Type *"
							item-text="value"
							item-value="key"
							outlined
						></v-select>
					</v-col>
					<v-col cols="6">
						<v-select
							v-model="food.use_for"
							multiple
							:rules="required"
							:items="slots"
							label="Slot *"
							item-text="value"
							item-value="key"
							outlined
						></v-select>
					</v-col>
				</v-row>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="default" :to="{ name: 'foods.list' }" text>
                Back
            </v-btn>
            <v-btn :disabled="!valid" :loading="loading" @click="save" color="primary">
                Save
            </v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    name: 'FoodForm',
    data: () => ({
        valid: false,
		slots: [],
		food_types: [],
        food: {
            id: null,
            name: '',
            type: '',
            use_for: [],
            details: '',
        },
        required: [v => !!v || "This field is required"],
        loading: false
    }),
    computed: {
    },
    mounted() {
        store.set("app/pageTitle", "Food Details");
        if(this.$route.params.id) this.loadData();
		this.getSlots();
		this.getFoodTypes();
    },
    methods: {
		getSlots() {
			this.$store.dispatch("food/getSlots")
				.then(response => {
					this.slots = response.data.slots.map(function(value, index){
						return {value, key:index.toString()};
					});
				})
		},
		getFoodTypes() {
			this.$store.dispatch("food/getFoodTypes")
				.then(response => {
					this.food_types = response.data.food_types.map(function(value, index){
						return {value, key: index.toString()};
					});
				})
		},
        loadData() {
            store
                .dispatch("food/getFoodDetails", this.$route.params.id)
                .then(response => {
                    this.food = response.data;
                })
                .catch(err => {
                    store.dispatch("app/error", "Failed to load Food Details");
                });
        },
        save() {
            if (this.valid) {
                let action = !this.food.id ? 'createFood' : 'updateFood';
                this.loading = true
                store
                    .dispatch(`food/${action}`, this.food)
                    .then(response => {
                        store.dispatch("app/success", `Successfully ${this.food.id ? "Updated" : "Created"}`);
                        this.$router.push({ name: "foods.list" });
                    })
                    .catch(err => {
						this.loading = false;
						const { message } = err.response.data || `Failed to ${this.formData.id ? 'update' : 'create'} Food`;
                        store.dispatch(
                            "app/error",
                            message
                        );
                    });
            }
        },
    }
};
</script>
