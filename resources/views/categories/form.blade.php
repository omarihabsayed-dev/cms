<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ isset($category) ? 'Edit Category' : 'Create Category' }}
            </h2>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-800 dark:bg-red-900/40 dark:border-red-600 dark:text-red-200 rounded-md text-sm">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}"
                      method="POST" class="space-y-6">
                    @csrf
                    @if(isset($category))
                        @method('PUT')
                    @endif

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Category Name
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $category->name ?? '') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                               placeholder="e.g. Technology">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                    <div class="flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                            {{ isset($category) ? 'Update Category' : 'Save Category' }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>