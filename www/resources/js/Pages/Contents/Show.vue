<template>
  <AppLayout>
    <div
      class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
      <h1 class="text-2xl font-bold mb-4">
        The content
      </h1>

      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        <ShowingContentMetas :key="formattedContent.id" :metaDatas="formattedContent.metadata" />
      </ul>

    </div>

  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import ShowingContentMetas from '../../components/ShowingContentMetas.vue';

export default {
  name: 'ContentsShow',
  components: {
    AppLayout,
    ShowingContentMetas
  },
  props: {
    content: Object
  },
  computed: {
    formattedContent() {
      return {
        id: this.content.id,
        metadata: this.content.metaDatasValues
      }
    }
  }
}
</script>