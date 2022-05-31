<template>
    <v-card>
        <v-card-text>
            <v-form ref="form" v-model="valid">
                <v-text-field
                    v-model="banner.description"
                    :rules="descriptionRules"
                    label="Description"
                    required
                    outlined
                ></v-text-field>

                <v-select
                    v-model="banner.order"
                    :items="[1, 2, 3, 4, 5]"
                    label="Order"
                    required
                    outlined
                ></v-select>

                <v-file-input
                    outlined
                    v-model="banner.imageFile"
                    accept="image/*"
                    label="Image"
                    @change="PreviewImage"
                    @click:clear="url=null"
                ></v-file-input>

                <v-img :src="url" max-height="150" max-width="250"></v-img>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn :to="{ name: 'banner.list' }" color="default" text>
                Back
            </v-btn>
            <v-btn
                :disabled="!valid"
                :loading="loading"
                @click="save"
                color="primary"
            >
                Save
            </v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    name: "BannerForm",
    data: () => ({
        valid: false,
        banner: {
            id: null,
            description: "",
            order: "",
            imageFile: null,
        },
        descriptionRules: [v => !!v || "Description is required"],
        loading: false,
        url: null,
    }),
    computed: {
    },
    mounted() {
        store.set("app/pageTitle", "Edit Banner");
        this.loadData();
    },
    methods: {
        PreviewImage() {
            this.url = URL.createObjectURL(this.banner.imageFile);
        },
        loadData() {
            store
                .dispatch("banner/show", this.$route.params.id)
                .then(response => {
                    this.banner = response.data;
                    this.url = this.banner.image.url
                })
                .catch(err => {
                    store.dispatch("app/error", "Failed to load Banner Details");
                });
        },
        save() {
            if (this.valid) {
                this.loading = true;
                store
                    .dispatch(`banner/update`, this.banner)
                    .then(response => {
                        store.dispatch(
                            "app/success",
                            `Successfully Updated`
                        );
                        this.$router.push({ name: "banner.list" });
                    })
                    .catch(err => {
                        this.loading = false;
						const { message } = err.response.data || `Failed to ${this.formData.id ? 'update' : 'create'} Banner`;
                        store.dispatch(
                            "app/error",
                            message
                        );
                    });
            }
        }
    }
};
</script>
