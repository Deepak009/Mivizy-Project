<template>
    <v-toolbar flat color="primary" dark>
        <v-toolbar-title
            >{{ feedback.user.name }}'s Diet Question Feedback</v-toolbar-title
        >
    </v-toolbar>
</template>
<script>
import { get } from "vuex-pathify";
export default {
    name: "DietQuestionFeedbackHeader",
    computed: {
        feedback: get("diet/questionFeedback")
    },
    methods: {}
};
</script>
