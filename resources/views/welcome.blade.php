<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header>
                        <div class="grid items-end grid-cols-1 gap-2 py-10">
                            @if (Route::has('login'))
                                <livewire:welcome.navigation />
                            @endif
                        </div>
                        <div class="w-full py-10 text-center">
                            <h1 class="text-4xl font-bold text-red-500">Login Zamurak</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-300">Bem-vindo ao Login Zamurak</p>
                        </div>
                    </header>

                    <main class="w-full p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Informações do Sistema</h2>
                        <div class="mt-4 space-y-4">
                            <div class="p-4 bg-gray-100 border rounded-lg dark:bg-gray-700">
                                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Versão do Laravel</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ app()->version() }}</p>
                            </div>
                            <div class="p-4 bg-gray-100 border rounded-lg dark:bg-gray-700">
                                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Versão do Livewire</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ \Composer\InstalledVersions::getVersion('livewire/livewire') }}</p>
                            </div>
                            <div class="p-4 bg-gray-100 border rounded-lg dark:bg-gray-700">
                                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Ambiente</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ app()->environment() }}</p>
                            </div>
                            <div class="p-4 bg-gray-100 border rounded-lg dark:bg-gray-700">
                                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">URL Base</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ config('app.url') }}</p>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-sm text-center text-black dark:text-white/70">
                        <a href="http://www.bdtechsolutions.com.br">BDTech Solutions</a> by Beny Allan
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
