<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen w-full px-4 sm:px-6 lg:px-8">
        <div class="relative w-full max-w-lg mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-8">
                <div x-data="{ activeTab: 'login' }">
                    <!-- Tabs -->
                    <div class="flex mb-6">
                        <button @click="activeTab = 'login'"
                                :class="{ 'border-b-2 border-gray-800 text-gray-800': activeTab === 'login', 'text-gray-500': activeTab !== 'login' }"
                                class="w-1/2 py-2 font-semibold text-center transition-colors duration-300 ease-in-out focus:outline-none">
                            Login
                        </button>
                        <button @click="activeTab = 'register'"
                                :class="{ 'border-b-2 border-gray-800 text-gray-800': activeTab === 'register', 'text-gray-500': activeTab !== 'register' }"
                                class="w-1/2 py-2 font-semibold text-center transition-colors duration-300 ease-in-out focus:outline-none">
                            Register
                        </button>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="overflow-hidden">
                        <div class="flex transition-transform duration-500 ease-in-out" :style="activeTab === 'login' ? 'transform: translateX(0)' : 'transform: translateX(-100%)'">
                            <!-- Login Form -->
                            <div class="w-full flex-shrink-0 px-2">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div>
                                        <x-input-label for="username" :value="__('Username')" class="text-gray-800" />
                                        <x-text-input id="username" class="block mt-1 w-full bg-gray-100 border-transparent focus:ring-gray-500 focus:border-gray-500" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="login_password" :value="__('Password')" class="text-gray-800" />
                                        <x-text-input id="login_password" class="block mt-1 w-full bg-gray-100 border-transparent focus:ring-gray-500 focus:border-gray-500" type="password" name="password" required autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="flex items-center justify-between mt-4">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="w-full flex justify-center bg-indigo-800 hover:bg-indigo-700">
                                            {{ __('Log in') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>

                            <!-- Registration Form -->
                            <div class="w-full flex-shrink-0 px-2">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div>
                                        <x-input-label for="name" :value="__('Name')" class="text-gray-800" />
                                        <x-text-input id="name" class="block mt-1 w-full bg-gray-100 border-transparent focus:ring-gray-500 focus:border-gray-500" type="text" name="name" :value="old('name')" required autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name', 'register')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="register_username" :value="__('Username')" class="text-gray-800" />
                                        <x-text-input id="register_username" class="block mt-1 w-full bg-gray-100 border-transparent focus:ring-gray-500 focus:border-gray-500" type="text" name="username" :value="old('username')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('username', 'register')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="register_password" :value="__('Password')" class="text-gray-800" />
                                        <x-text-input id="register_password" class="block mt-1 w-full bg-gray-100 border-transparent focus:ring-gray-500 focus:border-gray-500" type="password" name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password', 'register')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-800" />
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-100 border-transparent focus:ring-gray-500 focus:border-gray-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation', 'register')" class="mt-2" />
                                    </div>
                                    <div class="flex items-center justify-end mt-8">
                                        <x-primary-button class="w-full flex justify-center bg-indigo-800 hover:bg-indigo-700">
                                            {{ __('Register') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
