<template>
  <li class="py-4">
    <div class="flex justify-between items-start">

      <div class="mt-1 flex flex-wrap gap-x-6 gap-y-1 text-sm text-gray-600 dark:text-gray-400">
        <span v-for="metadata in metaDatas"><span class="text-gray-400">{{ metadata.metaName }}:</span> {{ metadata.metaValue }}</span>
      </div>

      <span class="text-sm text-green-600 dark:text-green-400 font-medium">
        {{ tag || "" }}
      </span>

    </div>
  </li>
</template>

<script>
export default {
  name: "ShowingSingleMeta",
  props: {
    metaDatas: {
      type: Array,
      required: true
    },
    tag: {
      type: String,
      required: false
    }
  }
}
</script>