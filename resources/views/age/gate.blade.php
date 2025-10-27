<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-4">Age Verification</h1>
        <p class="mb-6">You must be 21 years or older to enter this site.</p>
        <form action="/age-gate" method="POST">
            @csrf
            <button type="submit" name="action" value="confirm" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg w-full mb-4">
                I am 21 or older
            </button>
            <button type="submit" name="action" value="deny" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg w-full">
                I am under 21
            </button>
        </form>
    </div>
</body>
</html>
