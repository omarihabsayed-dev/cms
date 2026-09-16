<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ isset($post) ? 'Edit Post' : 'Create Post' }}
            </h2>
            <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                Back to Posts
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}"
                      method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if(isset($post))
                        @method('PUT')
                    @endif

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Title
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ isset($post) ? $post->title : '' }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                               placeholder="Enter post title">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                  placeholder="Short description...">{{ isset($post) ? $post->description : '' }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Content
                        </label>
                        <textarea name="content" 
                                  id="content" 
                                  rows="8"
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                  placeholder="Write your full content here...">{{ isset($post) ? $post->content : '' }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Upload Image
                        </label>
                        <input type="file" 
                               name="image" 
                               id="image"
                               class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 
                                    file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 
                                    hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                        
                        @if(isset($post) && $post->image)
                            <div class="mt-2">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Current image:</p>
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="mt-1 h-20 w-20 object-cover rounded-md border dark:border-gray-700">
                            </div>
                        @endif

                        @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Published At
                        </label>
                        <input type="datetime-local" 
                               name="published_at" 
                               id="published_at"
                               value="{{ (isset($post) && $post->published_at) ? $post->published_at->format('Y-m-d\TH:i') : '' }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                            {{ isset($post) ? 'Update' : 'Save' }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>