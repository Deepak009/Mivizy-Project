<template>
    <v-card>
        <DietQuestionFeedbackHeader />
        <DietQuestionFeedbackDetails />
        <v-divider></v-divider>
        <DietQuestionFeedbackBmi/>
        <diet-chart></diet-chart>
    </v-card>
</template>
<script>
import { get } from "vuex-pathify";
import DietQuestionFeedbackDetails from "../../components/diet-question-feedbacks/Details.vue";
import DietChart from "../../components/diet-question-feedbacks/DietChart.vue";
import DietQuestionFeedbackBmi from "../../components/diet-question-feedbacks/Bmi.vue";
import DietQuestionFeedbackHeader from "../../components/diet-question-feedbacks/Header.vue";

export default {
    name: "DietQuestionFeedbackView",
    components: {
        DietQuestionFeedbackHeader,
        DietQuestionFeedbackDetails,
        DietQuestionFeedbackBmi,
        DietChart
    },
    mounted() {
        store.set("app/pageTitle", "Diet Question Feedback Details");
        this.getDetails();
    },
    computed: {
        feedback: get("diet/questionFeedback")
    },
    methods: {
        getDetails() {
            store.dispatch(
                "diet/getQuestionFeedbackDetails",
                this.$route.params.id
            );
            store.dispatch(
                "diet/getDietChart",
                this.$route.params.id
            );
        }
    }
};
</script>
