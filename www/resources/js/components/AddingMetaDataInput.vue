<template>
  <div class="flex flex-col sm:flex-row gap-4">

    <div class="w-full sm:w-1/3">
      <label for="meta-name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
        Metadata Name
      </label>
      <input type="text" id="meta-name" :value="metaName"
        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        placeholder="Ex: name" @input="$emit('update:metaName', $event.target.value)">
    </div>

    <div class="w-full sm:w-2/3">

      <div class="flex items-center justify-between mb-1">
        <label for="meta-value" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Metadata
          Value</label>
        <div class="flex items-center">
          <input type="checkbox" id="long-text" v-model="isLongText" class="mr-2" @input="$emit('update:isLongText', $event.target.value)">
          <label for="long-text" class="text-sm text-gray-600 dark:text-gray-300">Long text</label>
        </div>
      </div>

      <input v-if="!isLongText" type="text" id="meta-value" :value="metaValue"
        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        placeholder="Value here" @input="$emit('update:metaValue', $event.target.value)">

      <textarea v-else id="meta-value" rows="4"
        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        placeholder="Enter long text here..." @input="$emit('update:longText', $event.target.value)" :value="longText"></textarea>
    </div>

  </div>
</template>

<script>
export default {
  name: 'AddingMetaDataInput',
  data() {
    return {
      isLongText: false
    }
  },
  props: {
    metaName: {
      type: String,
      required: true,
    },
    metaValue: {
      type: String,
      required: false
    },
    longText: {
      type: String,
      required: false
    }
  }
}
</script>