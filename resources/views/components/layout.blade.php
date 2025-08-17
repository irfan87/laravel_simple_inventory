<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? '' }} - {{ config('app.name', 'Inventory System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/search.js'])

        <!-- AlpineJS -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Global Search Configuration -->
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('autocomplete', () => ({
                    query: '',
                    results: [],
                    focusedIndex: -1,

                    async search() {
                        if (this.query.length < 2) {
                            this.results = [];
                            return;
                        }
                        
                        try {
                            const response = await fetch(`{{ route('products.search') }}?query=${encodeURIComponent(this.query)}`);
                            const data = await response.json();
                            this.results = data.results;
                            this.focusedIndex = -1;
                        } catch (error) {
                            console.error('Search error:', error);
                        }
                    },

                    focusNext() {
                        this.focusedIndex = Math.min(this.focusedIndex + 1, this.results.length - 1);
                    },

                    focusPrev() {
                        this.focusedIndex = Math.max(this.focusedIndex - 1, -1);
                    },

                    selectResult() {
                        if (this.results[this.focusedIndex]) {
                            window.location = this.results[this.focusedIndex].url;
                        }
                    }
                }));
            });
        </script>

        <!-- Tailwind Config -->
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                600: '#6366F1',
                                700: '#4F46E5',
                            },
                            secondary: '#38BDF8',
                            background: '#F8FAFC'
                        },
                        boxShadow: {
                            soft: '0 1px 3px 0 rgb(0 0 0 / 0.1)',
                        }
                    }
                }
            }
        </script>

    </head>
    <body class="min-h-screen bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-900">
        <main class="mx-auto p-6 w-full max-w-7xl pt-20">
            {{ $slot }}
        </main>
    </body>
</html>
