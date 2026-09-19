<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}
            </h2>
            <a href="{{ route('tags.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                Back to tags
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

                <form action="{{ isset($tag) ? route('tags.update', $tag) : route('tags.store') }}"
                      method="POST" class="space-y-6">
                    @csrf
                    @if(isset($tag))
                        @method('PUT')
                    @endif

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tag Name
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $tag->name ?? '') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                               placeholder="e.g. Technology">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                    <div class="flex justify-end">
                        <button type="submit" class="px-5 mt-3 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                            {{ isset($tag) ? 'Update Tag' : 'Save Tag' }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>