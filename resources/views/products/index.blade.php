<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-white rounded-lg shadow-lg mb-12 overflow-hidden">
                <div class="relative">
                    <img src="https://cdn.pixabay.com/photo/2020/04/05/18/20/vape-5007261_1280.jpg" alt="Vape products" class="w-full h-96 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <div class="text-center">
                            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">Find Your Flavor</h1>
                            <p class="text-lg md:text-xl text-gray-200">Explore our wide range of premium vape products</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Products Section -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Featured Products</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($products->take(4) as $product)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ config('currency.symbol') }}{{ number_format($product->price / 100, 2) }}" data-image="{{ $product->image }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600 mt-2">{{ config('currency.symbol') }}{{ number_format($product->price / 100, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Disposables Section -->
            <div class="mb-12">
                <h3 class="text-3xl font-bold text-gray-800 mb-6">Disposables</h3>
                <div id="disposables-container" class="flex overflow-x-auto space-x-8 p-4">
                    @foreach ($products->where('category.name', 'Disposables') as $product)
                        <div class="flex-shrink-0 w-80 bg-white rounded-lg shadow-lg overflow-hidden product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ config('currency.symbol') }}{{ number_format($product->price / 100, 2) }}" data-image="{{ $product->image }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600 mt-2">{{ config('currency.symbol') }}{{ number_format($product->price / 100, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- E-Liquid Section -->
            <div class="mb-12">
                <h3 class="text-3xl font-bold text-gray-800 mb-6">E-Liquid</h3>
                <div id="eliquid-container" class="flex overflow-x-auto space-x-8 p-4">
                    @foreach ($products->where('category.name', 'E-Liquid') as $product)
                        <div class="flex-shrink-0 w-80 bg-white rounded-lg shadow-lg overflow-hidden product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ config('currency.symbol') }}{{ number_format($product->price / 100, 2) }}" data-image="{{ $product->image }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600 mt-2">{{ config('currency.symbol') }}{{ number_format($product->price / 100, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Accessories Section -->
            <div class="mb-12">
                <h3 class="text-3xl font-bold text-gray-800 mb-6">Accessories</h3>
                <div id="accessories-container" class="flex overflow-x-auto space-x-8 p-4">
                    @foreach ($products->where('category.name', 'Accessories') as $product)
                        <div class="flex-shrink-0 w-80 bg-white rounded-lg shadow-lg overflow-hidden product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ config('currency.symbol') }}{{ number_format($product->price / 100, 2) }}" data-image="{{ $product->image }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600 mt-2">{{ config('currency.symbol') }}{{ number_format($product->price / 100, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>





    <x-product-modal />

@push('scripts')
    <script src="{{ asset('js/product-modal.js') }}"></script>
@endpush


        </div>
    </div>
</x-app-layout>
