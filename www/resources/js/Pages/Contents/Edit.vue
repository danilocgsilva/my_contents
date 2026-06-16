<template>
  <AppLayout>
    <div
      class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">

      <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
        Add Meta Contents
      </h1>

      <form class="space-y-6">
        <AddingMetaDataInput v-model:metaName="localMetaName" v-model:metaValue="localMetaValue"
          v-model:longText="localLongText" />

        <button type="button"
          class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-800 transition flex items-center justify-center gap-2"
          @click="addMetadata">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Add metadata
        </button>

        <div class="mt-8">
          <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
            Metadata summary
          </h2>

          <!-- Table implementation -->
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Meta Name
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Meta Value
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <tr v-for="metadata in metadataList" :key="metadata.id">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ metadata.name }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ metadata.value }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button type="button" @click="removeMetadata(metadata.id)"
                      class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition">
                      Remove
                    </button>
                  </td>
                </tr>
                <tr v-if="!metadataList.length">
                  <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                    No metadata added
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="flex justify-end">
          <button type="submit"
            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-800 transition"
            @click.prevent="submitForm">
            Save Content
          </button>
        </div>
      </form>





    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import AddingMetaDataInput from '../../components/AddingMetaDataInput.vue';
import { router } from '@inertiajs/vue3';

export default {
  name: 'ContentsCreate',
  components: {
    AppLayout,
    AddingMetaDataInput
  },
  props: {
    content: Object
  },
  data() {
    return {
      localMetaName: '',
      localMetaValue: '',
      localLongText: '',
      nextId: 1,
      metadataList: []
    }
  },
  mounted() {
    console.log(this.content);
    if (this.content && this.content.metaDatasValues) {
      this.metadataList = this.content.metaDatasValues.map((meta, index) => ({
        id: index + 1, // or use a unique ID if available
        name: meta.metaName,
        value: meta.metaValue
      }));
      this.nextId = this.metadataList.length > 0 ? Math.max(...this.metadataList.map(m => m.id)) + 1 : 1;
      console.log("Entrei!");
      console.log(this.metadataList);
    }
  },
  methods: {
    addMetadata() {
      if (!this.localMetaName.trim() || (!this.localMetaValue.trim() && !this.localLongText.trim())) {
        alert('Please fill in both the metadata name and value.');
        return;
      }

      this.metadataList.push({
        id: this.nextId++,
        name: this.localMetaName.trim(),
        value: this.localMetaValue.trim() || this.localLongText.trim()
      });

      this.localMetaName = '';
      if (this.localMetaValue.trim()) {
        this.localMetaValue = '';
      }
      if (this.localLongText.trim()) {
        this.localLongText = '';
      }
    },
    removeMetadata(id) {
      let answer = confirm("Are you sure you want to remove this metadata?");
      if (answer) {
        this.metadataList = this.metadataList.filter(metadata => metadata.id !== id);
      }
    },
    submitForm() {
      if (!this.metadataList.length) {
        alert('Please add at least one metadata.');
        return;
      }

      router.post('/contents', {
        metadatas: this.metadataList.map(({ name, value }) => ({ name, value }))
      });
    }
  }
}
</script>