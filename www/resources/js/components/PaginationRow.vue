<template>
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6">
    <div class="flex-1 flex justify-center">
      <div class="flex items-center space-x-1">

        <a :href="previousPageUrl || '#'"
          class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600"
          :class="{ 'cursor-not-allowed opacity-50': !previousPageUrl }"
          @click="!previousPageUrl && $event.preventDefault()">
          &laquo;
        </a>

        <a v-if="currentPage > 1" href="?page=1"
          class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">
          1
        </a>

        <span v-if="currentPage > 3" class="px-2 text-gray-400 dark:text-gray-400">...</span>

        <a v-if="previousPageUrl && currentPage > 2" 
          :href="previousPageUrl"
          class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">{{ previousPageNumber }}</a>
    
        <a href="#"
          class="px-3 py-1 rounded-lg border text-sm bg-blue-600 text-white dark:bg-blue-500 dark:text-white">
          {{ currentPage }}
        </a>

        <a v-if="nextPageUrl && currentPage < (lastPage - 1)" 
          :href="nextPageUrl"
          class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">{{  nextPageNumber }}</a>

        <span v-if="currentPage < (lastPage - 2)" class="px-2 text-gray-400 dark:text-gray-400">...</span>

        <a
          v-if="currentPage < lastPage" 
          :href="`?page=${lastPage}`"
          class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600">
          {{ lastPage }}
        </a>

        <a
          v-if="currentPage"
          :href="nextPageUrl || '#'" :class="{ 'cursor-not-allowed opacity-50': !nextPageUrl }"
          class="px-3 py-1 rounded-lg border text-sm bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-600"
          @click="!nextPageUrl && $event.preventDefault()">
          &raquo;
        </a>

      </div>
    </div>

    <form :action="pageAction" method="GET" class="relative flex justify-center sm:justify-end">
      <input type="number" name="page" min="1" placeholder="#"
        class="w-20 pr-8 pl-2 py-1 border rounded-lg bg-white text-gray-800 dark:bg-gray-700 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-400" />
      <button type="submit"
        class="absolute right-1 top-1/2 -translate-y-1/2 text-gray-500 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-300"
        title="Go">
        ➤
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: "PaginationRow",
  props: {
    lastPage: Object,
    currentPage: Object,
    nextPageUrl: Object,
    previousPageUrl: Object,
    previousPageNumber: Object,
    nextPageNumber: Object
  },
  computed: {
    pageAction() {
      return window.location.pathname
    }
  }
}
</script>