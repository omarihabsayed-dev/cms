<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Trix Editor CSS & JS -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Trix Dark Mode Overrides (Optional but highly recommended) -->
        <style>
            .trix-container {
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                overflow: hidden;
                background-color: #ffffff;
            }

            .dark .trix-container {
                border-color: #374151;
                background-color: #111827;
            }

            /* Base Toolbar Styling */
            trix-toolbar {
                background-color: #f9fafb;
                border-bottom: 1px solid #e5e7eb;
                padding: 0.5rem;
                display: flex;
                flex-wrap: wrap;
                gap: 0.375rem;
            }

            .dark trix-toolbar {
                background-color: #1f2937;
                border-bottom-color: #374151;
            }

            /* Hide unused tools */
            trix-toolbar .trix-button-group--file-tools,
            trix-toolbar .trix-button-group--history-tools {
                display: none !important;
            }

            /* Button Group Wrapper */
            trix-toolbar .trix-button-group {
                background-color: #ffffff;
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                margin: 0;
                overflow: hidden;
            }

            .dark trix-toolbar .trix-button-group {
                background-color: #111827;
                border-color: #374151;
            }

            /* Toolbar Buttons */
            trix-toolbar .trix-button {
                background-color: transparent;
                border: none;
                border-right: 1px solid #e5e7eb;
                padding: 0.35rem 0.5rem;
                transition: background-color 0.15s ease;
            }

            .dark trix-toolbar .trix-button {
                border-right-color: #374151;
            }

            trix-toolbar .trix-button:last-child {
                border-right: none;
            }

            trix-toolbar .trix-button:hover {
                background-color: #f3f4f6;
            }

            .dark trix-toolbar .trix-button:hover {
                background-color: #374151;
            }

            /* Active State */
            trix-toolbar .trix-button.trix-active {
                background-color: #6366f1 !important;
            }

            .dark trix-toolbar .trix-button.trix-active {
                background-color: #4f46e5 !important;
            }

            /* Icon Inversion for Dark Mode */
            .dark trix-toolbar .trix-button::before {
                filter: brightness(0) invert(1) !important;
            }

            trix-toolbar .trix-button.trix-active::before {
                filter: brightness(0) invert(1) !important;
            }

            /* Editor Field Styling */
            trix-editor {
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                padding: 0.75rem;
                min-height: 160px;
                background-color: #ffffff;
                color: #111827;
                font-size: 0.875rem;
                line-height: 1.5;
            }

            .dark trix-editor {
                background-color: #111827;
                color: #f3f4f6;
            }

            /* Placeholder Styling */
            trix-editor:empty:not(:focus)::before {
                color: #9ca3af;
            }

            .dark trix-editor:empty:not(:focus)::before {
                color: #6b7280;
            }

            /* List Formatting Fixes */
            .trix-content ul {
                list-style-type: disc !important;
                padding-left: 1.25rem !important;
            }

            .trix-content ol {
                list-style-type: decimal !important;
                padding-left: 1.25rem !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>