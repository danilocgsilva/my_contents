@extends('base')

{{-- Page Title --}}
@section('title', 'Create New Content - ' . config('app.name'))

{{-- SEO Meta Tags --}}
@section('description', 'Create new content with our easy-to-use form')
@section('keywords', 'create content, new post, content management')

{{-- Open Graph Meta Tags --}}
@section('og:title', 'Create New Content')
@section('og:description', 'Create new content with our easy-to-use form')

{{-- Additional Styles --}}
@push('styles')
<style>
    /* Custom styles for this page if needed */
    .form-container {
        transition: all 0.3s ease;
    }
</style>
@endpush

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    <li class="flex">
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-500">
                <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                <span class="sr-only">Home</span>
            </a>
        </div>
    </li>
    <li class="flex">
        <div class="flex items-center">
            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="{{ route('contents.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                Contents
            </a>
        </div>
    </li>
    <li class="flex">
        <div class="flex items-center">
            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="ml-4 text-sm font-medium text-gray-500" aria-current="page">
                Create
            </span>
        </div>
    </li>
@endsection

{{-- Page Header --}}
@section('page-header')
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Create New Content
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Fill out the form below to create a new piece of content.
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('contents.index') }}" 
               class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Back to List
            </a>
        </div>
    </div>
@endsection

{{-- Main Content --}}
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg">
            <form action="{{ route('contents.store') }}" method="POST" class="space-y-6 p-6">
                @csrf
                
                {{-- Title Field --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('title') border-red-300 @enderror"
                               placeholder="Enter content title..."
                               required>
                    </div>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category Field --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <select name="category_id" 
                                id="category_id"
                                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('category_id') border-red-300 @enderror"
                                required>
                            <option value="">Select a category...</option>
                            {{-- You would populate this with actual categories --}}
                            <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>Technology</option>
                            <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>Business</option>
                            <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>Lifestyle</option>
                        </select>
                    </div>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content Field --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1">
                        <textarea name="content" 
                                  id="content" 
                                  rows="8"
                                  class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('content') border-red-300 @enderror"
                                  placeholder="Write your content here..."
                                  required>{{ old('content') }}</textarea>
                    </div>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Field --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">
                        Status
                    </label>
                    <div class="mt-1">
                        <select name="status" 
                                id="status"
                                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('contents.index') }}" 
                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create Content
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Additional Scripts --}}
@push('scripts')
<script>
    // Auto-resize textarea
    document.getElementById('content').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Form validation feedback
    document.querySelector('form').addEventListener('submit', function(e) {
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Creating...
        `;
    });
</script>
@endpush