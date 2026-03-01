<template>
  <AppLayout>
    <div>
      <h1 class="text-2xl font-bold mb-4">
        Contents Index Page
      </h1>
      <p class="text-gray-600 dark:text-gray-400">
        Use the sun/moon icon in the header to switch between light and dark theme.
      </p>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'

export default {
  name: 'ContentsIndex',
  components: {
    AppLayout,
  },
  props: {
    // Define any props you want to receive from your controller
  },
  mounted() {
    console.log('Contents index page loaded')
  },
}
</script>
