<template>
    <v-tabs vertical>
        <v-tab v-for="(group, i) in feedback.feedback" :key="`group-${i}`">
            <v-icon left>
                mdi-label-variant-outline
            </v-icon>
            <span :title="group.label" class="text-truncate">
                {{ group.label }}
            </span>
        </v-tab>
        <v-tab-item
            v-for="(group, i) in feedback.feedback"
            :key="`group-details-${i}`"
        >
            <v-card flat>
                <v-card-text>
                    <v-row justify="center">
                        <v-expansion-panels focusable accordion>
                            <v-expansion-panel
                                v-for="(question, j) in group.questions"
                                :key="`question-${i}-${j}`"
                            >
                                <v-expansion-panel-header>
                                    Q: {{ question.label }}
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    {{ question.answer || "--" }}
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-tab-item>
    </v-tabs>
</template>
<script>
import { get } from "vuex-pathify";
export default {
    name: "DietQuestionFeedbackDetails",
    computed: {
        feedback: get("diet/questionFeedback")
    },
    methods: {
    }
};
</script>
