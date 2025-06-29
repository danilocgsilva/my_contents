@extends("base")

@section('title', 'Create New Content - ' . config('app.name'))

@section('description', 'Create new content with our easy-to-use form')

@section('keywords', 'create content, new post, content management')

@section('og:title', 'Create New Content')

@section('og:description', 'Create new content with our easy-to-use form')

@section('twitter:title', 'Create New Content')

@section('twitter:description', 'Create new content with our easy-to-use form')

@section('content-wrapper', 'container mx-auto px-4 max-w-4xl')

@section('main-class', 'py-12 bg-gray-100')

@section('content')
    <div class="form-container bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Create New Content</h1>
        
        @include('partials.errors')

        <form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('Contents.form')
            <button type="submit" class="btn btn-primary">Create Content</button>
        </form>
    </div>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('contents.index') }}" class="text-gray-500 hover:text-gray-700">
            Contents
        </a>
    </li>
    <li class="breadcrumb-item">
        <div class="flex items-center">
            <span class="text-gray-900 font-semibold">
                Create
            </span>
        </div>
    </li>
@endsection

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

@section('footer')
@endsection