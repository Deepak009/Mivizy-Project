<template>
    <v-row justify="center">
        <v-col cols="3">
            <v-card class="mx-auto" max-width="344" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-h5 mb-1">
                            {{ data.total_customer }}
                        </v-list-item-title>
                        <v-list-item-subtitle
                            >Total Customersdddd</v-list-item-subtitle
                        >
                    </v-list-item-content>

                    <v-list-item-avatar tile size="80">
                        <v-icon size="80">
                            mdi-account-group
                        </v-icon>
                    </v-list-item-avatar>
                </v-list-item>

                <v-card-actions>
                    <!-- <v-btn outlined rounded text>
                        Button
                    </v-btn> -->
                </v-card-actions>
            </v-card>
        </v-col>
        <v-col cols="3">
            <v-card class="mx-auto" max-width="344" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-h5 mb-1">
                            {{ data.blood_donors }}
                        </v-list-item-title>
                        <v-list-item-subtitle
                            >Total Blood Doners</v-list-item-subtitle
                        >
                    </v-list-item-content>

                    <v-list-item-avatar tile size="80">
                        <v-icon size="80">
                            mdi-account-multiple
                        </v-icon>
                    </v-list-item-avatar>
                </v-list-item>

                <v-card-actions>
                    <!-- <v-btn outlined rounded text>
                        Button
                    </v-btn> -->
                </v-card-actions>
            </v-card>
        </v-col>
        <v-col cols="3">
            <v-card class="mx-auto" max-width="344" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-h5 mb-1">
                            {{ data.current_customer }}
                        </v-list-item-title>
                        <v-list-item-subtitle>
                            Newly join customers.(current month)
                        </v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar tile size="80">
                        <v-icon size="80">
                            mdi-account-group
                        </v-icon>
                    </v-list-item-avatar>
                </v-list-item>

                <v-card-actions>
                    <!-- <v-btn outlined rounded text>
                        Button
                    </v-btn> -->
                </v-card-actions>
            </v-card>
        </v-col>
        <v-col cols="3">
            <v-card class="mx-auto" max-width="344" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-h5 mb-1">
                            {{ data.blood_request }}
                        </v-list-item-title>
                        <v-list-item-subtitle>
                            Blood request (current month)
                        </v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar tile size="80">
                        <v-icon size="80">
                            mdi-account-multiple
                        </v-icon>
                    </v-list-item-avatar>
                </v-list-item>

                <v-card-actions>
                    <!-- <v-btn outlined rounded text>
                        Button
                    </v-btn> -->
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>
<script>
export default {
    name: "AdminDashboard",
    data() {
        return {
            data: {
                total_customer: 0,
                blood_donors: 0,
                current_customer: 0,
                blood_request: 0
            }
        };
    },
    mounted() {
        store.dispatch("user/dashboardData").then(resp => {
            this.data = resp.data;
        });
    }
};
</script>
