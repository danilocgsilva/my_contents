<template>
  <AppLayout>
    <div
      class="max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
      <h1 class="text-2xl font-bold mb-4">
        Contents Index Page
      </h1>
      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        <ContentEntry
          v-for="content in contents" 
          :content="content"
          :key="content.id"
          :metaDatas="content.metaDatas"
        >
          <template #actions>
            <ButtonAnchor :href="route('contents.show', { content: content.id })">
              Details
            </ButtonAnchor>
          </template>
        </ContentEntry>
      </ul>

      <PaginationRow :lastPage="lastPage" :currentPage="currentPage" :nextPageUrl="nextPageUrl"
        :previousPageUrl="previousPageUrl" :nextPageNumber="nextPageNumber" :previousPageNumber="previousPageNumber">
      </PaginationRow>
    </div>
  </AppLayout>
</template>

<script lang="ts">

import { defineComponent } from 'vue'
import { route } from 'ziggy-js'
import AppLayout from '../../Layouts/AppLayout.vue'
import ContentEntry from '../../components/ContentEntry.vue'
import PaginationRow from '../../components/PaginationRow.vue';
import ButtonAnchor from '../../components/ButtonAnchor.vue';
import { MetaData } from '../../types/MetaData.ts';

interface Content {
  id: number;
  metaDatas: MetaData[];
}

export default defineComponent({
  name: 'ContentsIndex',
  components: {
    AppLayout,
    ContentEntry,
    PaginationRow,
    ButtonAnchor
  },
  props: {
    contents: {
      type: Object as () => Content[],
      required: true
    },
    nextPageUrl: {
      type: String,
      default: null
    },
    previousPageUrl: {
      type: String,
      default: null
    },
    currentPage: {
      type: Number,
      required: true
    },
    lastPage: {
      type: Number,
      required: true
    },
    nextPageNumber: {
      type: Number,
      default: null
    },
    previousPageNumber: {
      type: Number,
      default: null
    },
  },
  methods: {
    route
  }
})

</script>
