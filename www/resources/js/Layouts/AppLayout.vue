<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors">
    <header class="border-b border-gray-200 dark:border-gray-700">
      <div class="w-full max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
          <h1 class="text-xl font-semibold">My Contents</h1>
          <button 
            @click="toggleMenu"
            class="lg:hidden p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none"
            aria-label="Toggle menu"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
        
        <div class="hidden lg:flex items-center space-x-6">
          <a href="#" class="font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Home</a>
          <a href="#" class="font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Articles</a>
          <a href="#" class="font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">About</a>
          <a href="#" class="font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Contact</a>
        </div>
        
        <ThemeToggle />
      </div>
      
      <!-- Mobile menu -->
      <div v-show="isMenuOpen" class="lg:hidden border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="px-4 py-3 space-y-2">
          <a href="#" class="block py-2 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Home</a>
          <a href="#" class="block py-2 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Articles</a>
          <a href="#" class="block py-2 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">About</a>
          <a href="#" class="block py-2 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Contact</a>
        </div>
      </div>
    </header>
    
    <main class="p-4">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import ThemeToggle from '../components/ThemeToggle.vue'

const isMenuOpen = ref(false)

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value
}
</script>