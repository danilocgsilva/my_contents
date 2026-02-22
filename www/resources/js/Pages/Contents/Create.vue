<template>
  <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Meta Content</h1>

    <form class="space-y-6">
      <!-- Campo para nome e valor do metadata -->
      <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
          <label for="meta-name" class="block text-sm font-medium text-gray-700 mb-1">Metadata Name</label>
          <input type="text" id="meta-name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Ex: name">
        </div>
        <div class="flex-1">
          <label for="meta-value" class="block text-sm font-medium text-gray-700 mb-1">Metadata Value</label>
          <input type="text" id="meta-value" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Value here">
        </div>
      </div>

      <!-- Botão para adicionar novo campo -->
      <button type="button" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Add metadata
      </button>

      <!-- Área para listar metadados adicionados -->
      <div class="mt-8">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Metadata summary</h2>
        <div id="meta-list" class="space-y-4">
          <!-- Exemplo de item de metadata -->
          <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <div>
              <p class="font-medium text-gray-800">name</p>
              <p class="text-gray-600">My favorite movie</p>
            </div>
            <button type="button" class="text-red-500 hover:text-red-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Botão de submit -->
      <div class="flex justify-end">
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
          Save Content
        </button>
      </div>
    </form>
  </div>
</template>