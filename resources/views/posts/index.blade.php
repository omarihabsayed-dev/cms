<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $isTrash ? 'Trash' : 'Posts' }}
            </h2>
            @if(!$isTrash)
                <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                    + Add Post
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <form action="{{ request()->url() }}" method="GET" class="flex gap-2">
                    <div class="relative flex-1">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search posts..." 
                            class="w-full px-4 py-2 pl-10 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                        Search
                    </button>

                    @if(request('search'))
                        <a href="{{ request()->url() }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium rounded-md transition flex items-center">
                            Clear
                        </a>
                    @endif
                </form>
            </div>
            
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 dark:bg-green-900/40 dark:border-green-600 dark:text-green-200 rounded-md text-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($posts as $post)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        
                        <div class="h-48 w-full overflow-hidden bg-gray-200 dark:bg-gray-700">
                            <a href="{{ route('posts.show', $post) }}">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </a>
                        </div>



                        <div class="p-6 flex-1 flex flex-col">
                            @if($post->category)
                                <div class="mb-2">
                                    <a href="{{ route('categories.show', $post->category) }}" 
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 hover:bg-indigo-200 dark:bg-indigo-900/50 dark:text-indigo-300 dark:hover:bg-indigo-900/80 transition">
                                        {{ $post->category->name }}
                                    </a>
                                </div>
                            @endif

                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate" title="{{ $post->title }}">
                                {{ $post->title }}
                            </h3>
                            
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 flex-1">
                                {{ Str::limit($post->description, 120) }} 
                            </p>

                            <div class="mt-3 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $post->published_at->format('M d, Y - h:i A') }}
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-end items-center gap-2">
                                @if($isTrash)
                                    <form action="{{ route('posts.restore', $post) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to restore this post?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium rounded-md border border-indigo-200 text-indigo-600 hover:bg-indigo-600 hover:border-indigo-600 hover:text-white dark:border-indigo-800 dark:text-indigo-400 dark:hover:bg-indigo-600 dark:hover:text-white transition">
                                            Restore
                                        </button>
                                    </form>

                                    <form action="{{ route('posts.force-delete', $post) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to permanently delete this post? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium rounded-md border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white dark:border-red-800 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white transition">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('posts.edit', $post) }}"
                                       class="px-3 py-1.5 text-xs font-medium rounded-md border border-indigo-200 text-indigo-600 hover:bg-indigo-600 hover:border-indigo-600 hover:text-white dark:border-indigo-800 dark:text-indigo-400 dark:hover:bg-indigo-600 dark:hover:text-white transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium rounded-md border border-red-200 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white dark:border-red-800 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white transition">
                                            Trash
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-span-full text-center py-12 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">
                            {{ $isTrash ? 'No trashed posts found.' : 'No posts found. Click "+ Add Post" to create one.' }}
                        </p>
                    </div>
                @endforelse
            </div>
            <div class="mt-6">
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>