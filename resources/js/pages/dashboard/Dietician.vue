<template>
    <v-row justify="center">
        <v-col cols="4">
            <v-card class="mx-auto" max-width="344" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-h5 mb-1">
                            {{ data.diet_chart_last_month }}
                        </v-list-item-title>
                        <v-list-item-subtitle
                            >Diet chart created (last
                            month)</v-list-item-subtitle
                        >
                    </v-list-item-content>

                    <v-list-item-avatar tile size="80">
                        <v-icon size="80">
                            mdi-chart-arc
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
        <v-col cols="4">
            <v-card class="mx-auto" max-width="344" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-h5 mb-1">
                            {{ data.diet_chart_current_month }}
                        </v-list-item-title>
                        <v-list-item-subtitle
                            >Diet chart created (current
                            month)</v-list-item-subtitle
                        >
                    </v-list-item-content>

                    <v-list-item-avatar tile size="80">
                        <v-icon size="80">
                            mdi-chart-arc
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
        <v-col cols="4">
            <v-card class="mx-auto" max-width="344" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <v-list-item-title class="text-h5 mb-1">
                            {{ data.diet_chart_pending }}
                        </v-list-item-title>
                        <v-list-item-subtitle
                            >Diet chart pending (current
                            month)</v-list-item-subtitle
                        >
                    </v-list-item-content>

                    <v-list-item-avatar tile size="80">
                        <v-icon size="80">
                            mdi-chart-arc
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
    name: "DieticianDashboard",
    data() {
        return {
            data: {
                diet_chart_last_month: 0,
                diet_chart_current_month: 0,
                diet_chart_pending: 0
            }
        };
    },
    mounted() {
        store.dispatch('user/dashboardData')
            .then(resp => {
                this.data = resp.data
            })
    }
};
</script>
