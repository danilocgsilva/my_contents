<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors">

    <header class="border-b border-gray-200 dark:border-gray-700">
      <div class="w-full max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <h1 class="text-xl font-semibold">
          My Contents
        </h1>
        <ThemeToggle />
      </div>
    </header>
    
    <main class="p-4">
      <slot />
    </main>
  </div>
</template>

<script setup>
import ThemeToggle from '../components/ThemeToggle.vue'
</script>

