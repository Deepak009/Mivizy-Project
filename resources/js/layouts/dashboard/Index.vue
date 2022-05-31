<template>
    <div>
        <default-bar />

        <default-drawer />

        <v-main>
            <v-container fluid>
                <router-view />
            </v-container>
        </v-main>

        <default-footer />

        <default-settings />
    </div>
</template>

<script>
export default {
    name: "DashboardLayout",

    components: {
        DefaultBar: () =>
            import(
                /* webpackChunkName: "default-app-bar" */
                "./AppBar"
            ),
        DefaultDrawer: () =>
            import(
                /* webpackChunkName: "default-drawer" */
                "./Drawer"
            ),
        DefaultFooter: () =>
            import(
                /* webpackChunkName: "default-footer" */
                "./Footer"
            ),
        DefaultSettings: () =>
            import(
                /* webpackChunkName: "default-settings" */
                "./Settings"
            ),
        DefaultView: () =>
            import(
                /* webpackChunkName: "default-view" */
                "./View"
            )
    },
    data() {
        return {
            unsubscribe: null
        }
    },
    mounted() {
        this.unsubscribe = store.subscribeAction((action, state) => {
            if(action.type == 'user/logout') {
                this.$store.commit("user/user", false);
                this.$router.push("login");
                this.$store.dispatch('app/success', 'Successfully Logged out!')
            }
        });
    },
    beforeDestroy() {
        this.unsubscribe();
    }
};
</script>
