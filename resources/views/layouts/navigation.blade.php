<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    @php
        use Cart;
    @endphp
    <!-- Logo -->
    <div class="flex justify-center py-4">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Kapnos Logo" class="block h-16 w-auto">
        </button>
    </div>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'staff'))
                    <x-nav-link :href="route('admin.orders.list')" :active="request()->routeIs('admin.orders.list')">
                        {{ __('Orders') }}
                    </x-nav-link>
                    <x-nav-link href="#" :active="false">
                        {{ __('Brand') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                        {{ __('Products') }}
                    </x-nav-link>
                    <x-nav-link href="#" :active="false">
                        {{ __('E-liquid') }}
                    </x-nav-link>
                    <x-nav-link href="#" :active="false">
                        {{ __('Accessories') }}
                    </x-nav-link>
                @else
                    <x-nav-link href="#" :active="false">
                        {{ __('BRANDS') }}
                    </x-nav-link>
                    <x-nav-link href="#" :active="false">
                        {{ __('DISPOSABLES') }}
                    </x-nav-link>
                    <x-nav-link href="#" :active="false">
                        {{ __('E-LIQUID') }}
                    </x-nav-link>
                    <x-nav-link href="#" :active="false">
                        {{ __('ACCESSORIES') }}
                    </x-nav-link>
                @endif
            </div>

            <!-- Icons -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'staff'))
                    <!-- Settings Icon -->
                    <a href="{{ route('profile.edit') }}" class="p-2 text-gray-400 hover:text-white focus:outline-none focus:text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </a>

                    <!-- Logout Icon -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-white focus:outline-none focus:text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                @else
                    <!-- Search Icon -->
                    <button class="p-2 text-gray-400 hover:text-white focus:outline-none focus:text-white">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                    <!-- Profile Icon -->
                    <a href="{{ route('profile.edit') }}" class="p-2 text-gray-400 hover:text-white focus:outline-none focus:text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                    <!-- Shopping Cart Icon -->
                    <button @click="isCartVisible = !isCartVisible" class="relative p-2 text-gray-400 hover:text-white focus:outline-none focus:text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        @if (Cart::count() > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>
                        @endif
                    </button>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'staff'))
                <x-responsive-nav-link :href="route('admin.orders.list')" :active="request()->routeIs('admin.orders.list')">
                    {{ __('Orders') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('Brand') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                    {{ __('Products') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('E-liquid') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('Accessories') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('BRANDS') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('DISPOSABLES') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('E-LIQUID') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">
                    {{ __('ACCESSORIES') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log In') }}
                </x-responsive-nav-link>
                @if (Route::has('register'))
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
                @endif
            </div>
        </div>
        @endauth
    </div>
</nav>
