<template>
  <!-- <v-container>
    <v-row align="center">
      <v-spacer class="hidden-sm-and-down" />

      <v-col
        cols="12"
        md="auto"
      >
        <div class="text-body-1 font-weight-light pt-6 pt-md-0 text-center">
          &copy; {{ (new Date()).getFullYear() }}, Made by <v-icon>mdi-vuetify</v-icon>
          <a
            href="https://vuetifyjs.com/en/about/meet-the-team/#company"
            class="text-decoration-none"
          >HA</a>
        </div>
      </v-col>
    </v-row>
  </v-container> -->
</template>

<script>
  export default {
    name: 'Links',

    data: () => ({
      links: [
        {
          href: '#',
          text: 'About Us',
        },
        {
          href: '#',
          text: 'Blog',
        },
        {
          href: '#',
          text: 'Licenses',
        },
      ],
    }),
  }
</script>

<style lang="sass" scoped>
  a
    color: inherit !important
</style>
