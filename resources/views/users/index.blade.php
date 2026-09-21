<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Users
            </h2>
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

                @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-800 dark:bg-red-900/40 dark:border-red-600 dark:text-red-200 rounded-md text-sm">
                    {{ session('error') }}
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-20">ID</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3 w-48 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end items-center gap-2 whitespace-nowrap">
                                            <form action="{{ route('users.make-admin', $user) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @if(!$user->isAdmin())
                                                <button type="submit"
                                                        class="px-3 py-1.5 text-xs font-medium rounded-md border border-indigo-200 text-indigo-600 hover:bg-indigo-600 hover:border-indigo-600 hover:text-white dark:border-indigo-800 dark:text-indigo-400 dark:hover:bg-indigo-600 dark:hover:text-white transition">
                                                    Make Admin
                                                </button>
                                                @endif
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No users found.
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