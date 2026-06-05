<template>
  <li class="py-4 px-6">
    <div class="flex flex-col justify-between items-start">
      <div class="mt-1 flex flex-wrap gap-x-6 gap-y-1 text-sm text-gray-600 dark:text-gray-400">
        <ul>
          <li v-for="metadata in metaDatas" v-bind:key="metadata.metaName">
            <span class="text-gray-400">{{ metadata.metaName }}</span>:
            {{ metadata.metaValue }}
          </li>
        </ul>
      </div>

      
      <a
        :href="route('contents.show', { content: content.id })"
        type="button"
        class="
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
        "
      >
        Manage
    </a>
    </div>
  </li>
</template>

<script>
export default {
  name: "ContentEntry",
  props: {
    metaDatas: {
      type: Array,
      required: true
    },
    content: {
      type: Object,
      required: true
    }
  }
}
</script>