document.addEventListener('DOMContentLoaded', function () {
    const containers = [
        { id: 'disposables-container', interval: 3000 },
        { id: 'eliquid-container', interval: 3500 },
        { id: 'accessories-container', interval: 4000 }
    ];

    containers.forEach(containerInfo => {
        const container = document.getElementById(containerInfo.id);
        if (container) {
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
        }
    });

    const productModal = document.getElementById('product-modal');
    const closeModal = document.getElementById('close-modal');
    const productCards = document.querySelectorAll('.product-card');

    const modalProductId = document.getElementById('modal-product-id');
    const modalProductName = document.getElementById('modal-product-name');
    const modalProductPrice = document.getElementById('modal-product-price');
    const modalProductImage = document.getElementById('modal-product-image');

    if (productCards.length > 0 && productModal) {
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

            const quantityInput = document.getElementById('quantity');

            if (e.target.closest('#quantity-plus')) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            }

            if (e.target.closest('#quantity-minus')) {
                const currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            }
        });
    }

    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const button = this.querySelector('button[type="submit"]');
            const originalButtonText = button.innerHTML;

            // Disable button and show loading state
            button.disabled = true;
            button.innerHTML = 'Adding...';

            const formData = new FormData(this);

            fetch(this.action, {
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
                    button.classList.add('success');

                    // Update the cart modal in the background
                    updateCartModal();

                    // Close the modal and reset the button after a delay
                    setTimeout(() => {
                        productModal.classList.add('hidden');
                        button.disabled = false;
                        button.innerHTML = originalButtonText;
                        button.classList.remove('success');
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
    }

    function updateCartModal() {
        fetch('/cart/data') // Hardcoded URL, consider passing from Blade
            .then(response => response.json())
            .then(data => {
                const cartModal = document.getElementById('cart-modal-content');
                const cartCount = document.getElementById('cart-count');
                let html = '';

                if (cartModal) {
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
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
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
        <p>${data.cartSubtotal}</p>
    </div>
    <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
    <div class="mt-6">
        <a href="/checkout" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
    </div>
    <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
        <p>or <button type="button" @click="isCartVisible = false" class="font-medium text-indigo-600 hover:text-indigo-500">Continue Shopping <span aria-hidden="true"> &rarr;</span></button></p>
    </div>
</div>`;
                    } else {
                        html = `<div class="flex items-center justify-center h-full"><p class="text-lg text-gray-500">Your cart is empty.</p></div>`;
                    }

                    cartModal.innerHTML = html;
                }

                if (cartCount) {
                    cartCount.textContent = data.cartCount;
                }

                window.dispatchEvent(new CustomEvent('cart-updated'));
            });
    }
});
