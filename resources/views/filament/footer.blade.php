<footer class="fixed inset-x-0 bottom-0 w-full bg-white dark:bg-gray-900 py-2 text-sm text-gray-600 shadow z-50">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-center px-6">
        <!-- Footer Text (Centered on Mobile, Left on Large Screens) -->
        <p class="text-center mt-2 md:mt-0 md:text-left">
            &copy; {{ date('Y') }} {{ $settings->site_name ?? "My Application" }} - {{ $settings->site_footer }}
        </p>

        <!-- Social Media Icons: Moves Below on Mobile -->
        <div class="flex space-x-6 mt-2 md:mt-0 mx-3 md:mx-0">
            <!-- Facebook -->
            <a href="{{ $settings->facebook_url ?? '#' }}" target="_blank"
               class="px-1 py-1 mx-1 border border-gray-300 rounded-md bg-gray-100 hover:bg-blue-600 hover:text-white dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-blue-500 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22 12.06C22 6.48 17.52 2 12 2S2 6.48 2 12.06c0 5 3.66 9.12 8.45 9.94V14.4h-2.54v-2.34h2.54v-1.84c0-2.5 1.5-3.89 3.77-3.89 1.1 0 2.25.2 2.25.2v2.46h-1.27c-1.25 0-1.64.78-1.64 1.58v1.49h2.78l-.44 2.34h-2.34v7.6c4.79-.82 8.45-4.94 8.45-9.94z"/>
                </svg>
            </a>

            <!-- Twitter/X -->
            <a href="{{ $settings->twitter_url ?? '#' }}" target="_blank"
               class="px-1 py-1 mx-1 border border-gray-300 rounded-md bg-gray-100 hover:bg-blue-400 hover:text-white dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-blue-300 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23 3a10.9 10.9 0 01-3.14.86 4.48 4.48 0 002-2.48 9.72 9.72 0 01-3.14 1.2A4.72 4.72 0 0016 2a4.49 4.49 0 00-4.69 4.69c0 .36.03.7.1 1.03a12.93 12.93 0 01-9.38-4.76 4.72 4.72 0 00-.64 2.34c0 1.61.8 3.03 2.03 3.87a4.49 4.49 0 01-2.07-.57v.05a4.49 4.49 0 003.59 4.39c-.47.13-.98.2-1.5.2-.36 0-.72-.03-1.07-.1.72 2.23 2.78 3.86 5.22 3.89A9.05 9.05 0 012 19.5a12.72 12.72 0 007 2.08c8.43 0 13.1-7 13.1-13.07v-.6A9.48 9.48 0 0023 3z"/>
                </svg>
            </a>

            <!-- Instagram -->
            <a href="{{ $settings->instagram_url ?? '#' }}" target="_blank"
               class="px-1 py-1 mx-1 border border-gray-300 rounded-md bg-gray-100 hover:bg-pink-500 hover:text-white dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-pink-400 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7.5 2h9A5.5 5.5 0 0122 7.5v9A5.5 5.5 0 0116.5 22h-9A5.5 5.5 0 012 16.5v-9A5.5 5.5 0 017.5 2zm0 2A3.5 3.5 0 004 7.5v9A3.5 3.5 0 007.5 20h9A3.5 3.5 0 0020 16.5v-9A3.5 3.5 0 0016.5 4h-9zM12 7a5 5 0 110 10A5 5 0 0112 7zm0 2a3 3 0 100 6 3 3 0 000-6zm4.5-2a1 1 0 110 2 1 1 0 010-2z"/>
                </svg>
            </a>

            <!-- LinkedIn -->
            <a href="{{ $settings->linkedin_url ?? '#' }}" target="_blank"
               class="px-1 py-1 mx-1 border border-gray-300 rounded-md bg-gray-100 hover:bg-blue-700 hover:text-white dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-blue-500 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 3a2 2 0 012-2h12a2 2 0 012 2v18a2 2 0 01-2 2H6a2 2 0 01-2-2V3zm5.5 7H7v8h2.5v-8zM8.25 6a1.25 1.25 0 100 2.5A1.25 1.25 0 008.25 6zm8 4H14v1.15h.03c.56-1.06 1.98-1.37 3.1-1.37 3.32 0 3.93 2.18 3.93 5.03V20h-2.5v-4.56c0-1.26-.02-2.88-1.76-2.88-1.76 0-2.03 1.38-2.03 2.8V20H14V10z"/>
                </svg>
            </a>
        </div>
    </div>
</footer>
