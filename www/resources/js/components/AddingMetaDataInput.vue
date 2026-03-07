<template>
  <div class="flex flex-col sm:flex-row gap-4">
    <div class="flex-1">
      <label for="meta-name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
        Metadata Name
      </label>
      <input type="text" id="meta-name"
        :value="metaName"
        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        placeholder="Ex: name"
        @input="$emit('update:metaName', $event.target.value)"
        >
    </div>
    <div class="flex-1">
      <label for="meta-value" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
        Metadata Value
      </label>
      <input type="text" id="meta-value"
        :value="metaValue"
        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        placeholder="Value here"
        @input="$emit('update:metaValue', $event.target.value)"
        >
    </div>
  </div>
</template>

<script>
export default {
  name: 'AddingMetaDataInput',
  props: {
    metaName: {
      type: String,
      required: true
    },
    metaValue: {
      type: String,
      required: true
    }
  }
}
</script>