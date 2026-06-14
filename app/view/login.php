<?php require_once __DIR__ . '/../header.php'; ?>

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-3xl font-bold text-center mb-6">
            Login
        </h1>

        <form>
            <input
                type="email"
                placeholder="Email"
                class="w-full border p-3 rounded mb-4">

            <input
                type="password"
                placeholder="Password"
                class="w-full border p-3 rounded mb-4">

            <button
                class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../footer.php'; ?>