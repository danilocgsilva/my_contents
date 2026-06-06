<template>
  <li class="py-4 px-6">
    <div class="flex flex-col justify-between items-start">
      <div
        class="mt-1 flex flex-wrap gap-x-6 gap-y-1 text-sm text-gray-600 dark:text-gray-400"
      >
        <ul>
          <li v-for="metadata in metaDatas" v-bind:key="metadata.metaName">
            <span class="text-gray-400">{{ metadata.metaName }}</span
            >:
            {{ metadata.metaValue }}
          </li>
        </ul>
      </div>
      <slot name="actions"></slot>
    </div>
  </li>
</template>

<script>
export default {
  name: "ContentEntry",
  props: {
    metaDatas: {
      type: Array,
      required: true,
    },
    content: {
      type: Object,
      required: true,
    },
  },
};
</script>