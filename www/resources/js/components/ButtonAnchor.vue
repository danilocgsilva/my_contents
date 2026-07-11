<template>
  <a :href="href" type="button" class="
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
        ">
    Manage
  </a>
</template>

<script setup lang="ts">

interface Props {
  href: string
}

defineOptions({
  name: "ButtonAnchor"
});

defineProps<Props>()

</script>