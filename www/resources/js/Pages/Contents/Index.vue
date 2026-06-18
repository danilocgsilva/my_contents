<template>
  <AppLayout>
    <div
      class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
      <h1 class="text-2xl font-bold mb-4">
        Contents Index Page
      </h1>
      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        <ContentEntry v-for="content in formattedContents" :content="content" :key="content.id"
          :metaDatas="content.metadata">
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
              Manage
            </a>
          </template>
        </ContentEntry>
      </ul>

      <PaginationRow :lastPage="lastPage" :currentPage="currentPage" :nextPageUrl="nextPageUrl"
        :previousPageUrl="previousPageUrl" :nextPageNumber="nextPageNumber" :previousPageNumber="previousPageNumber">
      </PaginationRow>

    </div>

  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import ContentEntry from '../../components/ContentEntry.vue'
import PaginationRow from '../../components/PaginationRow.vue';

export default {
  name: 'ContentsIndex',
  components: {
    AppLayout,
    ContentEntry,
    PaginationRow,
  },
  props: {
    contents: Object,
    nextPageUrl: String,
    previousPageUrl: String,
    currentPage: Number,
    lastPage: Number,
    nextPageNumber: Number,
    previousPageNumber: Number,
  },
  computed: {
    formattedContents() {
      let formattedContentsObj = this.contents.map(content => {
        return {
          id: content.id,
          metadata: content.metaDatas
        }
      })
      return formattedContentsObj;
    }
  }
}
</script>
