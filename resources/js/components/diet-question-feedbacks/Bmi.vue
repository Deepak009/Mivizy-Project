<template>
    <v-card class="d-flex flex-row m-6 justify-space-between" flat>
        <v-chip class="ma-2" :color="bmiColor" label text-color="white">
            BMI: {{ bmi }}
        </v-chip>
        <v-card small class="d-flex flex-row mb-6" flat tile>
            <v-card class="pa-2" outlined tile color="yellow">
                Underweight < 18.5
            </v-card>
            <v-card class="pa-2" outlined tile color="green">
                Normal weight 18.5 - 25
            </v-card>
            <v-card class="pa-2" outlined tile color="orange">
                Overweight 25 - 30
            </v-card>
            <v-card class="pa-2" outlined tile color="red">
                Obese > 30
            </v-card>
        </v-card>
    </v-card>
</template>
<script>
import { get } from "vuex-pathify";
export default {
    name: "DietQuestionFeedbackBmi",
    computed: {
        feedback: get("diet/questionFeedback"),
        height() {
            return (
                (this.feedback?.feedback && this.feedback?.feedback[0]
                    ? this.feedback?.feedback[0].questions[0].answer
                    : 1) / 100
            );
        },
        weight() {
            return this.feedback?.feedback && this.feedback?.feedback[0]
                ? this.feedback?.feedback[0].questions[1].answer
                : 0;
        },
        bmi() {
            return (this.weight / (this.height * this.height)).toFixed(2);
        },
        bmiColor() {
            let bmi = parseFloat(this.bmi);
            if (bmi < 18.5) {
                return "yellow";
            } else if (bmi >= 18.5 && bmi < 25) {
                return "green";
            } else if (bmi >= 25 && bmi < 30) {
                return "orange";
            } else if (bmi > 30) {
                return "red";
            } else {
                return "white";
            }
        }
    },
    methods: {}
};
</script>
