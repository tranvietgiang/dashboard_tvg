<?php require_once __DIR__ . '/header.php'; ?>

<main class="min-h-screen bg-[radial-gradient(circle_at_top_left,_#dbeafe,_transparent_32%),linear-gradient(135deg,_#f8fafc_0%,_#eef2ff_45%,_#f8fafc_100%)] px-4 py-10 sm:px-6 lg:px-8">
    <section class="mx-auto flex min-h-[calc(100vh-5rem)] w-full max-w-6xl items-center justify-center">
        <div class="grid w-full overflow-hidden rounded-lg border border-slate-200 bg-white shadow-xl shadow-slate-200/70 lg:grid-cols-[1.05fr_0.95fr]">
            <div class="hidden bg-slate-950 px-10 py-12 text-white lg:flex lg:flex-col lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-sky-300">Dashboard TVG</p>
                    <h1 class="mt-5 max-w-md text-4xl font-bold leading-tight">
                        Quan ly he thong gon gang, bao mat, san sang lam viec.
                    </h1>
                    <p class="mt-5 max-w-md text-sm leading-6 text-slate-300">
                        Dang nhap de truy cap bang dieu khien, API token va cac tinh nang quan tri noi bo.
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-3 text-sm">
                    <div class="rounded-md border border-white/10 bg-white/5 p-4">
                        <p class="text-2xl font-bold text-white">CSRF</p>
                        <p class="mt-1 text-slate-400">Form token</p>
                    </div>
                    <div class="rounded-md border border-white/10 bg-white/5 p-4">
                        <p class="text-2xl font-bold text-white">XSS</p>
                        <p class="mt-1 text-slate-400">Escape HTML</p>
                    </div>
                    <div class="rounded-md border border-white/10 bg-white/5 p-4">
                        <p class="text-2xl font-bold text-white">SQL</p>
                        <p class="mt-1 text-slate-400">Prepared</p>
                    </div>
                </div>
            </div>

            <div class="px-6 py-10 sm:px-10 lg:px-12">
                <div class="mx-auto w-full max-w-md">
                    <div class="mb-8">
                        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-sky-700">Welcome back</p>
                        <h2 class="mt-3 text-3xl font-bold text-slate-950">Dang nhap</h2>
                        <p class="mt-2 text-sm text-slate-500">
                            Nhap tai khoan admin de vao dashboard.
                        </p>
                    </div>

                    <form method="post" action="/api/login" class="space-y-5" id="loginForm">
                        <?= CsrfMiddleware::input() ?>

                        <label class="block">
                            <span class="mb-2 block text-sm font-medium text-slate-700">Email</span>
                            <input
                                type="email"
                                name="email"
                                placeholder="admin@example.com"
                                autocomplete="email"
                                required
                                class="block w-full rounded-md border border-slate-300 bg-white px-4 py-3 text-sm text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-sky-500 focus:ring-4 focus:ring-sky-100">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-medium text-slate-700">Mat khau</span>
                            <input
                                type="password"
                                name="password"
                                placeholder="Nhap mat khau"
                                autocomplete="current-password"
                                required
                                class="block w-full rounded-md border border-slate-300 bg-white px-4 py-3 text-sm text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-sky-500 focus:ring-4 focus:ring-sky-100">
                        </label>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-md bg-sky-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700 focus:outline-none focus:ring-4 focus:ring-sky-200">
                            Dang nhap
                        </button>
                    </form>

                    <p class="mt-3 hidden text-sm font-medium text-slate-700" id="loginMessage"></p>

                    <div class="mt-6 rounded-md border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
                        <p class="font-medium text-slate-800">Tai khoan mac dinh</p>
                        <p class="mt-1">Email: <span class="font-mono text-slate-900">admin@example.com</span></p>
                        <p>Password: <span class="font-mono text-slate-900">admin123</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="/assets/js/login.js"></script>

<?php require_once __DIR__ . '/footer.php'; ?>
