<template>
  <button 
    :type="type" 
    class="
      px-6 py-2 
      rounded-lg 
      focus:outline-none 
      focus:ring-2
      focus:ring-offset-2 
      transition 
      flex 
      items-center 
      gap-2
      "
    :class="buttonClasses"
  >
    <slot />
  </button>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps<{
  type: "button" | "submit" | "reset" | undefined;
  variant?: "primary" | "danger";
}>();

const buttonClasses = computed(() => {
  if (props.variant === 'danger') {
    return [
      'bg-red-600',
      'text-white',
      'hover:bg-red-700',
      'focus:ring-red-500',
      'focus:ring-offset-white',
      'dark:focus:ring-offset-gray-800'
    ]
  }
  
  return [
    'bg-blue-600',
    'text-white',
    'hover:bg-blue-700',
    'focus:ring-blue-500',
    'focus:ring-offset-white',
    'dark:focus:ring-offset-gray-800'
  ]
})
</script>