<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
                @if (Route::has('login'))
                    <nav class="flex flex-1 items-center justify-end gap-4">
                        <div class="absolute top-0 right-0 p-6">
                            @auth
                            <a
                                href="{{ url('/notes') }}"
                                class=" text-indigo-600 hover:text-indigo-800 leading-normal"
                            >
                                Notes
                            </a>
                            @else
                            <a
                            href="{{ route('login') }}"
                            class=" text-indigo-600 hover:text-indigo-800 leading-normal"
                            >
                            Log in
                        </a>
                        
                        @if (Route::has('register'))
                        <a
                        href="{{ route('register') }}"
                        class=" text-indigo-600 hover:text-indigo-800 leading-normal ml-2">
                        Register
                    </a>
                    @endif
                    @endauth
                </div>
            </nav>
            @endif
            </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main></main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
        </div>
    </body>
</html>
