<template>
    <v-container fluid tag="section">
        <AdminDashboard v-if="user.is_admin"/>
        <DieticianDashboard v-else/>
    </v-container>
</template>

<script>
import AdminDashboard from './Admin.vue';
import DieticianDashboard from './Dietician.vue';

export default {
    name: "Dashboard",
    components:{
        AdminDashboard,
        DieticianDashboard
    },
    data() {
        return {
            user: {}
        }
    },
    async mounted() {
        store.set("app/pageTitle", "Dashboard");
        this.user = await store.dispatch("user/getUser");

    }
};
</script>
