<template>
    <v-container id="user-profile-view" fluid tag="section">
    </v-container>
</template>

<script>
export default {
    name: "UserProfileView",
    mounted() {
        store.set("app/pageTitle", "Dashboard");
    }
};
</script>
