<template>
  <button :type="type" class="
            px-6 py-2 
            bg-red-600 
            text-white 
            rounded-lg 
            hover:bg-red-700 
            focus:outline-none 
            focus:ring-2
            focus:ring-red-500 
            focus:ring-offset-2 
            focus:ring-offset-white 
            dark:focus:ring-offset-gray-800 
            transition 
            flex 
            items-center 
            gap-2
          ">
    <slot />
  </button>
</template>

<script setup lang="ts">

defineProps<{
  type: "button" | "submit" | "reset" | undefined;
}>();

</script>