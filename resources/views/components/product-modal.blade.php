<!-- Product Modal -->
<div id="product-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-4xl relative">
        <button id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Image -->
            <div>
                <img id="modal-product-image" src="" alt="Product Image" class="w-full h-auto object-cover rounded-lg shadow-md">
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-center">
                <h3 id="modal-product-name" class="text-3xl font-bold text-gray-900 mb-2"></h3>
                <p id="modal-product-price" class="text-2xl text-gray-700 mb-4"></p>

                <form id="add-to-cart-form" action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="modal-product-id" name="product_id">

                    <!-- Quantity Selector -->
                    <div class="flex items-center space-x-3 mb-6">
                        <label for="quantity" class="text-lg font-medium text-gray-700">Quantity:</label>
                        <div class="flex items-center">
                            <button type="button" id="quantity-minus" class="px-3 py-1 border border-gray-300 rounded-l-md hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 text-center border-t border-b border-gray-300">
                            <button type="button" id="quantity-plus" class="px-3 py-1 border border-gray-300 rounded-r-md hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col space-y-3">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition-colors duration-300">
                            Add to Cart
                        </button>
                        @auth
                        <a href="{{ route('cart.index') }}" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg text-lg transition-colors duration-300">
                            Go to Checkout
                        </a>
                        @endauth
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
