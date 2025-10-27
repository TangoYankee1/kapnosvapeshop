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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" x-data="{ isCartVisible: false, isCheckoutModalVisible: false, isSuccessModalVisible: false }" @cart-updated.window="isCartVisible = true" @open-checkout-modal.window="isCheckoutModalVisible = true">
        <x-cart-modal />
        <x-checkout-success-modal />
        <div class="min-h-screen bg-gray-100">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>

                <!-- Page Footer -->
                <footer class="bg-gray-800 text-white mt-8">
                    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                            <div class="space-y-8 xl:col-span-1">
                                <img class="h-10" src="{{ asset('images/logo.png') }}" alt="Kapnos">
                                <p class="text-gray-400 text-base">
                                    Vape shop with three branches.
                                </p>
                                <div class="flex space-x-6">
                                    <!-- Add social media links here -->
                                </div>
                            </div>
                            <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                                <div class="md:grid md:grid-cols-2 md:gap-8">
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Solutions</h3>
                                        <ul class="mt-4 space-y-4">
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Marketing</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Analytics</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Commerce</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Insights</a></li>
                                        </ul>
                                    </div>
                                    <div class="mt-12 md:mt-0">
                                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Support</h3>
                                        <ul class="mt-4 space-y-4">
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Pricing</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Documentation</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Guides</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">API Status</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="md:grid md:grid-cols-2 md:gap-8">
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Company</h3>
                                        <ul class="mt-4 space-y-4">
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">About</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Blog</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Jobs</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Press</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Partners</a></li>
                                        </ul>
                                    </div>
                                    <div class="mt-12 md:mt-0">
                                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Legal</h3>
                                        <ul class="mt-4 space-y-4">
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Claim</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Privacy</a></li>
                                            <li><a href="#" class="text-base text-gray-300 hover:text-white">Terms</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-12 border-t border-gray-700 pt-8">
                            <p class="text-base text-gray-400 xl:text-center">&copy; {{ date('Y') }} Kapnos. All rights reserved.</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        @include('checkout.modal')
    </body>
</html>
