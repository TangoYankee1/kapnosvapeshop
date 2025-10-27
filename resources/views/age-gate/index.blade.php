<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="max-w-md w-full bg-white shadow-md rounded-lg p-8 text-center">
            <h1 class="text-3xl font-bold mb-4">Age Verification</h1>
            <p class="text-gray-600 mb-6">You must be 21 years or older to enter this site.</p>

            <form method="POST" action="{{ route('age-gate.store') }}">
                @csrf
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    I am 21 or older
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
