<template>
  <AppLayout>
    <div
      class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
      <h1 class="text-2xl font-bold mb-4">
        The content
      </h1>

      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
  <ContentEntry :content="formattedContent" :metaDatas="formattedContent.metadata">
    <template #actions>
      <div class="flex items-center gap-2">
        <ButtonAnchor :href="route('contents.edit', { content: content })">
          Edit
        </ButtonAnchor>
        <form :action="route('contents.destroy', { content: content.id })" method="POST"
          @submit.prevent="confirmDelete" class="inline-block">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" :value="csrfToken">

          <button type="submit" class="
            px-6 py-2 
            bg-red-600 
            text-white 
            rounded-lg 
            hover:bg-red-700 
            focus:outline-none 
            focus:ring-2
            focus:ring-red-500 
            focus:ring-offset-2 
            focus:ring-offset-white 
            dark:focus:ring-offset-gray-800 
            transition 
            flex 
            items-center 
            gap-2
          ">
            Delete
          </button>
        </form>
        
      </div>
    </template>
  </ContentEntry>
</ul>

    </div>
  </AppLayout>
</template>

<script>

import { route } from 'ziggy-js';
import AppLayout from '../../Layouts/AppLayout.vue';
import ContentEntry from '../../components/ContentEntry.vue';
import ButtonAnchor from '../../components/ButtonAnchor.vue';

export default {
  name: 'ContentsShow',
  components: {
    AppLayout,
    ContentEntry,
    ButtonAnchor
  },
  props: {
    content: Object,
    csrfToken: String
  },
  computed: {
    formattedContent() {
      return {
        id: this.content.id,
        metadata: this.content.metaDatasValues ?? []
      }
    }
  },
  methods: {
    confirmDelete(event) {
      if (confirm('Are you sure you want to delete this content?')) {
        event.target.submit();
      }
    }
  }
}
</script>
