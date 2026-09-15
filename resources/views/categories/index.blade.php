<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Categories
            </h2>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                + Add Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 dark:bg-green-900/40 dark:border-green-600 dark:text-green-200 rounded-md text-sm">
                    {{ session('success') }}
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-20">ID</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3 w-48 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($categories as $category)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                                        {{ $category->id }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end items-center gap-2 whitespace-nowrap">
                                            <a href="{{ route('categories.edit', $category) }}"
                                               class="px-3 py-1.5 text-xs font-medium rounded-md border border-indigo-200 text-indigo-600 hover:bg-indigo-600 hover:border-indigo-600 hover:text-white dark:border-indigo-800 dark:text-indigo-400 dark:hover:bg-indigo-600 dark:hover:text-white transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1.5 text-xs font-medium rounded-md border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white dark:border-red-800 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No categories found. Click "+ Add Category" to create one.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>