<template>
  <AppLayout>
    <div
      class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
      <h1 class="text-2xl font-bold mb-4">
        The content
      </h1>

      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        <ContentEntry 
          :content="formattedContent" 
          :metaDatas="formattedContent.metadata" 
        >
        <template #actions>
                      <a :href="route('contents.show', { content: content.id })" type="button" class="
          w-full 
          sm:w-auto 
          px-6 py-2 
          bg-blue-600 
          text-white 
          rounded-lg 
          hover:bg-blue-700 
          focus:outline-none 
          focus:ring-2
          focus:ring-blue-500 
          focus:ring-offset-2 
          focus:ring-offset-white 
          dark:focus:ring-offset-gray-800 
          transition 
          flex 
          items-center 
          gap-2
        ">
              Delete
            </a>
        </template>
        </ContentEntry>
      </ul>

    </div>

  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import ContentEntry from '../../components/ContentEntry.vue';

export default {
  name: 'ContentsShow',
  components: {
    AppLayout,
    ContentEntry
  },
  props: {
    content: Object
  },
  computed: {
    formattedContent() {
      return {
        id: this.content.id,
        metadata: this.content.metaDatasValues ?? []
      }
    }
  }
}
</script>