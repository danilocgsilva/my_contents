<template>
  <AppLayout>
    <div
      class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
      <h1 class="text-2xl font-bold mb-4">
        Contents Index Page
      </h1>
      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        <ShowingSingleMeta v-for="content in formattedContents" :key="content.id" :metaDatas="content.metadata" />
      </ul>
    </div>
  </AppLayout>
</template>

<script>
import { toHandlers } from 'vue';
import AppLayout from '../../Layouts/AppLayout.vue'
import ShowingSingleMeta from '../../components/ShowingSingleMeta.vue'

export default {
  name: 'ContentsIndex',
  components: {
    AppLayout,
    ShowingSingleMeta,
  },
  props: {
    contents: Object
  },
  computed: {
    formattedContents() {
      let formattedContentsObj = this.contents.map(content => {
        return {
          id: content.id,
          metadata: content.metadata.map(metadata => {
            return {
              metaName: metadata.meta_name,
              metaValue: metadata.valueable.value
            }
          })
        }
      })
      return formattedContentsObj;
    }
  }
}
</script>
