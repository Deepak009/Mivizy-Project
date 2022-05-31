<template>
    <v-app>
        <v-snackbar
            top
            right
            v-model="notification.show"
            :color="notification.type"
        >
            {{ notification.message }}
            <template v-slot:action="{ attrs }">
                <v-btn text v-bind="attrs" @click="notification.show = false">
                    X
                </v-btn>
            </template>
        </v-snackbar>
        <router-view :layout.sync="layout" v-slot="{ Component }">
            <v-fade-transition mode="out-in">
                <component :is="Component" />
            </v-fade-transition>
        </router-view>
    </v-app>
</template>

<script>
import { sync } from "vuex-pathify";
export default {
    name: "App",
    computed: {
        notification: sync("app@notification")
    },
    data() {
        return {
            layout: "div"
        };
    },
    created() {}
};
</script>
