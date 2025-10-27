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
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="${{ number_format($product->price / 100, 2) }}" data-image="{{ $product->image }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600 mt-2">${{ number_format($product->price / 100, 2) }}</p>
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
                        <div class="flex-shrink-0 w-80 bg-white rounded-lg shadow-lg overflow-hidden product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="${{ number_format($product->price / 100, 2) }}" data-image="{{ $product->image }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600 mt-2">${{ number_format($product->price / 100, 2) }}</p>
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
                        <div class="flex-shrink-0 w-80 bg-white rounded-lg shadow-lg overflow-hidden product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="${{ number_format($product->price / 100, 2) }}" data-image="{{ $product->image }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600 mt-2">${{ number_format($product->price / 100, 2) }}</p>
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
                        <div class="flex-shrink-0 w-80 bg-white rounded-lg shadow-lg overflow-hidden product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="${{ number_format($product->price / 100, 2) }}" data-image="{{ $product->image }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-56 object-cover object-center">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600 mt-2">${{ number_format($product->price / 100, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>



    <!-- Product Modal -->
    <div id="product-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <div class="flex justify-end">
                <button id="close-modal" class="text-gray-500 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="text-center">
                <img id="modal-product-image" src="" alt="Product Image" class="w-full h-64 object-cover object-center rounded-lg mb-4">
                <h3 id="modal-product-name" class="text-2xl font-bold text-gray-800"></h3>
                <p id="modal-product-price" class="text-xl text-gray-600 mt-2"></p>
                @auth
                <div class="mt-6 flex items-center justify-center space-x-4">
                    <form id="add-to-cart-form" action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="modal-product-id" name="product_id">
                        <div class="flex items-center justify-center">
                            <label for="quantity" class="mr-2">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 text-center border-gray-300 rounded-md">
                        </div>
                        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Add to Cart
                        </button>
                    </form>
                    <a href="{{ route('cart.index') }}" class="mt-4 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Checkout
                    </a>
                </div>
                @else
                <form id="add-to-cart-form" action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="modal-product-id" name="product_id">
                    <div class="mt-4 flex items-center justify-center">
                        <label for="quantity" class="mr-2">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 text-center border-gray-300 rounded-md">
                    </div>
                    <button type="submit" class="mt-6 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Add to Cart
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const containers = [
                { id: 'disposables-container', interval: 3000 },
                { id: 'eliquid-container', interval: 3500 },
                { id: 'accessories-container', interval: 4000 }
            ];

            containers.forEach(containerInfo => {
                const container = document.getElementById(containerInfo.id);
                let scrollAmount = 0;
                const scrollStep = container.clientWidth;

                setInterval(() => {
                    if (scrollAmount < container.scrollWidth - container.clientWidth) {
                        scrollAmount += scrollStep;
                    } else {
                        scrollAmount = 0;
                    }
                    container.scrollTo({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                }, containerInfo.interval);
            });

            const productModal = document.getElementById('product-modal');
            const closeModal = document.getElementById('close-modal');
            const productCards = document.querySelectorAll('.product-card');

            const modalProductId = document.getElementById('modal-product-id');
            const modalProductName = document.getElementById('modal-product-name');
            const modalProductPrice = document.getElementById('modal-product-price');
            const modalProductImage = document.getElementById('modal-product-image');

            productCards.forEach(card => {
                card.addEventListener('click', () => {
                    const id = card.dataset.id;
                    const name = card.dataset.name;
                    const price = card.dataset.price;
                    const image = card.dataset.image;

                    modalProductId.value = id;
                    modalProductName.textContent = name;
                    modalProductPrice.textContent = price;
                    modalProductImage.src = image;

                    productModal.classList.remove('hidden');
                });
            });

            closeModal.addEventListener('click', () => {
                productModal.classList.add('hidden');
            });

            productModal.addEventListener('click', (e) => {
                if (e.target === productModal) {
                    productModal.classList.add('hidden');
                }
            });

            const addToCartForm = document.getElementById('add-to-cart-form');

            addToCartForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const button = this.querySelector('button[type="submit"]');
                const originalButtonText = button.innerHTML;

                // Disable button and show loading state
                button.disabled = true;
                button.innerHTML = 'Adding...';

                const formData = new FormData(this);

                fetch('{{ route('cart.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success state
                        button.innerHTML = 'Added! <svg class="inline-block w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                        button.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                        button.classList.add('bg-green-500');

                        // Update the cart modal in the background
                        updateCartModal();

                        // Close the modal and reset the button after a delay
                        setTimeout(() => {
                            productModal.classList.add('hidden');
                            button.disabled = false;
                            button.innerHTML = originalButtonText;
                            button.classList.remove('bg-green-500');
                            button.classList.add('bg-blue-500', 'hover:bg-blue-600');
                        }, 1500);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Reset button on error
                    button.disabled = false;
                    button.innerHTML = originalButtonText;
                });
            });

            function updateCartModal() {
                fetch('{{ route('cart.data') }}')
                    .then(response => response.json())
                    .then(data => {
                        const cartModal = document.getElementById('cart-modal-content');
                        const cartCount = document.getElementById('cart-count');
                        let html = '';

                        if (data.cartCount > 0) {
                            html += `<ul role="list" class="my-6 divide-y divide-gray-200">
`;
                            for (const [rowId, item] of Object.entries(data.cartItems)) {
                                html += `<li class="flex py-6">
    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
        <img src="${item.options.image ? '/storage/' + item.options.image : 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg'}" alt="${item.name}" class="h-full w-full object-cover object-center">
    </div>
    <div class="ml-4 flex flex-1 flex-col">
        <div>
            <div class="flex justify-between text-base font-medium text-gray-900">
                <h3><a href="#">${item.name}</a></h3>
                <p class="ml-4">${(item.price * item.qty).toFixed(2)}</p>
            </div>
        </div>
        <div class="flex flex-1 items-end justify-between text-sm">
            <p class="text-gray-500">Qty ${item.qty}</p>
            <div class="flex">
                <form action="/cart/${rowId}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                </form>
            </div>
        </div>
    </div>
</li>`;
                            }
                            html += `</ul>`;
                            html += `<div class="border-t border-gray-200 px-4 py-6 sm:px-6">
    <div class="flex justify-between text-base font-medium text-gray-900">
        <p>Subtotal</p>
        <p>$${data.cartSubtotal}</p>
    </div>
    <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
    <div class="mt-6">
        <a href="{{ route('checkout.index') }}" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
    </div>
    <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
        <p>or <button type="button" @click="isCartVisible = false" class="font-medium text-indigo-600 hover:text-indigo-500">Continue Shopping <span aria-hidden="true"> &rarr;</span></button></p>
    </div>
</div>`;
                        } else {
                            html = `<div class="flex items-center justify-center h-full"><p class="text-lg text-gray-500">Your cart is empty.</p></div>`;
                        }

                        cartModal.innerHTML = html;
                        cartCount.textContent = data.cartCount;
                        window.dispatchEvent(new CustomEvent('cart-updated'));
                    });
            }
        });
    </script>


        </div>
    </div>
</x-app-layout>
