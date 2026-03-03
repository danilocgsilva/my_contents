<template>
  <AppLayout>
    <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
        Add Meta Content
      </h1>

      <form class="space-y-6">
        <!-- Campo para nome e valor do metadata -->
        <div class="flex flex-col sm:flex-row gap-4">
          <div class="flex-1">
            <label
              for="meta-name"
              class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1"
            >
              Metadata Name
            </label>
            <input
              type="text"
              id="meta-name"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
              placeholder="Ex: name"
            >
          </div>
          <div class="flex-1">
            <label
              for="meta-value"
              class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1"
            >
              Metadata Value
            </label>
            <input
              type="text"
              id="meta-value"
              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
              placeholder="Value here"
            >
          </div>
        </div>

        <!-- Botão para adicionar novo campo -->
        <button
          type="button"
          class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-800 transition flex items-center justify-center gap-2"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd"
            />
          </svg>
          Add metadata
        </button>

        <div class="mt-8">
          <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
            Metadata summary
          </h2>
          <div id="meta-list" class="space-y-4">

            <MetaDataAdded
              v-for="metadata in metadataList"
              :key="metadata.id"
              :name="metadata.name"
              :value="metadata.value"
            />

          </div>
        </div>

        <div class="flex justify-end">
          <button
            type="submit"
            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-800 transition"
          >
            Save Content
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import MetaDataAdded from '../../components/MetaDataAdded.vue';

export default {
  name: 'ContentsCreate',
  components: {
    AppLayout,
    MetaDataAdded
  },
  data() {
    return {
      metadataList: [
        {
          id: 1,
          name: "name",
          value: "Danilo"
        },
        {
          id: 2,
          name: "birthdate",
          value: "02/02/1987"
        }
      ]
    }
  }
}
</script>
