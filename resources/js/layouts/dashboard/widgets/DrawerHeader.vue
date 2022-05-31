<template>
 <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h6">
            Dashboard
          </v-list-item-title>
         
        </v-list-item-content>
      </v-list-item>
 <!-- <v-list-item class="mb-0 justify-space-between px-0 pt-2">
     <v-img
      lazy-src="/images/mivi-logo.jfif"
      max-height="50"
      max-width="250"
      :aspect-ratio="16/9"
      src="/images/mivi-logo-small.jpg"
    ></v-img> -->
    <!-- <v-list-item-avatar>
      <v-img
        :src="
          require('@/assets/vmd.svg')"
      />
    </v-list-item-avatar>

    <v-list-item-content class="pl-2">
      <v-list-item-title class="text-h3">
        <strong class="mr-1 font-weight-black">Health App</strong>

        <span class="primary--text">FREE</span>
      </v-list-item-title>
    </v-list-item-content> -->
    
  <!-- </v-list-item> -->
</template>

<script>
  // Utilities
  import { get } from 'vuex-pathify'

  export default {
    name: 'DefaultDrawerHeader',

    computed: { version: get('app/version') },
  }
</script>
