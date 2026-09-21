<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Post Details
            </h2>
            <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                &larr; Back to Posts
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- Cover Image --}}
                @if($post->image)
                    <div class="h-80 w-full overflow-hidden bg-gray-200 dark:bg-gray-700">
                        <img src="{{ asset('storage/' . $post->image) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-8">
                    {{-- Category Badge & Published Date --}}
                    <div class="flex items-center justify-between gap-4 mb-4">
                        @if($post->category)
                            <a href="{{ route('categories.show', $post->category) }}" 
                               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300 hover:bg-indigo-200 transition">
                                {{ $post->category->name }}
                            </a>
                        @endif

                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ optional($post->published_at)->format('M d, Y - h:i A') ?? $post->created_at->format('M d, Y') }}
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        {{ $post->title }}
                    </h1>

                    @if($post->description)
                        <p class="text-lg text-gray-600 dark:text-gray-300 font-medium mb-6 leading-relaxed border-l-4 border-indigo-500 pl-4 italic">
                            {{ $post->description }}
                        </p>
                    @endif

                    <hr class="border-gray-200 dark:border-gray-700 my-6" />

                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                        {!! $post->content !!}
                    </div>

                    {{-- Tags Section --}}
                    @if($post->tags && $post->tags->count())
                        <div class="mt-8 pt-4 border-t border-gray-100 dark:border-gray-700/60">
                            <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">
                                Tags
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('tags.show', $tag) }}" 
                                       class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                        <a href="{{ route('posts.edit', $post) }}" class="px-4 py-2 text-sm font-medium rounded-md border border-indigo-200 text-indigo-600 hover:bg-indigo-600 hover:text-white dark:border-indigo-800 dark:text-indigo-400 transition">
                            Edit Post
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>