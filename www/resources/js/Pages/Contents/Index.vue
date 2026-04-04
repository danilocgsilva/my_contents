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
      <p>Next page: {{ nextPageUrl }}</p>
      <p>Previous page: {{ previousPageUrl }}</p>


      <!-- Pagination Row -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6">
        <!-- Centered Pagination -->
        <div class="flex-1 flex justify-center">
          <div class="flex items-center space-x-1">

            <!-- Previous -->
            <a :href="previousPageUrl" class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">&laquo;</a>

            <!-- First page -->
            <a href="?page=1" class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">1</a>

            <!-- Ellipsis -->
            <span class="px-2 text-gray-400 dark:text-gray-400">...</span>

            <!-- Nearby pages -->
            <a href="?page=4" class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">4</a>
            <a href="#" class="px-3 py-1 rounded-lg border text-sm bg-blue-600 text-white dark:bg-blue-500 dark:text-white">{{ currentPage }}</a>
            <a href="?page=6" class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">6</a>

            <!-- Ellipsis -->
            <span class="px-2 text-gray-400 dark:text-gray-400">...</span>

            <!-- Last page -->
            <a href="?page=20" class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">20</a>

            <!-- Next -->
            <a :href="nextPageUrl" class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">&raquo;</a>

          </div>
        </div>

        <!-- Go to page -->
        <form action="" method="GET" class="relative flex justify-center sm:justify-end">
          <input type="number" name="page" min="1" placeholder="#"
            class="w-20 pr-8 pl-2 py-1 border rounded-lg bg-white text-gray-800 dark:bg-gray-700 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-400" />
          <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 text-gray-500 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-300"
            title="Go">
            ➤
          </button>
        </form>
      </div>



    </div>

  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import ShowingSingleMeta from '../../components/ShowingSingleMeta.vue'

export default {
  name: 'ContentsIndex',
  components: {
    AppLayout,
    ShowingSingleMeta,
  },
  props: {
    contents: Object,
    nextPageUrl: Object,
    previousPageUrl: Object,
    currentPage: Object
  },
  computed: {
    formattedContents() {
      let formattedContentsObj = this.contents.map(content => {
        return {
          id: content.id,
          metadata: content.metaDatasValues
        }
      })
      return formattedContentsObj;
    }
  }
}
</script>
