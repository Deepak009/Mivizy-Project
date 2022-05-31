<template>
  <v-row justify="center">
    <v-dialog
      :value="true"
      persistent
      max-width="300px"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Delete Confirmation</span>
        </v-card-title>
        <v-card-text>
          <small>Are you sure want to delete the OPD Schedule?</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
           @click="$emit('close')"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="$emit('deleteItem')"
          >
            Delete
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
export default {
    name: "confirmationDelete",
    data() {
        return {
            dialog: false
        }
    },
    props: {
        show: {default:false}
    },
    computed: {
        showDialog() {
            return this.dialog;
        }
    }
}
</script>