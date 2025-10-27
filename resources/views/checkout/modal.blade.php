<div
    x-data="{
        show: false,
        branches: [],
        fetchBranches() {
            fetch('{{ route("checkout.index") }}')
                .then(response => response.json())
                .then(data => {
                    this.branches = data.branches;
                });
        },
        submitForm(event) {
            event.preventDefault();
            const formData = new FormData(event.target);

            fetch('{{ route("checkout.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                this.show = false;
                this.$dispatch('cart-updated'); // to refresh cart count
                this.$dispatch('show-success-modal');
            });
        }
    }"
    x-show="show"
    x-on:open-checkout-modal.window="show = true; fetchBranches()"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    style="display: none;"
>
    <div @click.away="show = false" class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-4">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-6">Checkout</h2>
            <form @submit.prevent="submitForm">
                @csrf

                <h3 class="text-xl font-semibold mb-4">Shipping Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="shipping_address" id="shipping_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="shipping_city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="shipping_city" id="shipping_city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="shipping_state" class="block text-sm font-medium text-gray-700">State</label>
                        <input type="text" name="shipping_state" id="shipping_state" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="shipping_zip" class="block text-sm font-medium text-gray-700">ZIP Code</label>
                        <input type="text" name="shipping_zip" id="shipping_zip" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                </div>

                <h3 class="text-xl font-semibold mt-6 mb-4">Fulfillment Branch</h3>
                <div>
                    <label for="branch_id" class="block text-sm font-medium text-gray-700">Select a branch for pickup</label>
                    <select name="branch_id" id="branch_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        <option value="">-- Select a Branch --</option>
                        <template x-for="branch in branches" :key="branch.id">
                            <option :value="branch.id" x-text="branch.name"></option>
                        </template>
                    </select>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" @click="show = false" class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Place Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
