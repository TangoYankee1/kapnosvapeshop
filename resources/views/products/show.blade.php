<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/350' }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg">
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="font-bold text-2xl">{{ config('currency.symbol') }}{{ number_format($product->price, 2) }}</span>
                                <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
