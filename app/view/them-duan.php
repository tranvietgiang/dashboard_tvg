<?php require_once __DIR__ . '/header.php'; ?>

<main class="min-h-screen bg-slate-50 text-slate-900">
    <div class="grid min-h-screen grid-cols-1 lg:grid-cols-[240px_minmax(0,1fr)]">
        <aside class="border-b border-slate-200 bg-white p-5 lg:border-b-0 lg:border-r lg:p-7">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.12em] text-blue-600">Dashboard TVG</p>
                <h1 class="mt-2 text-2xl font-bold tracking-normal text-slate-950">Bang dieu khien</h1>
            </div>

            <nav class="mt-8 grid grid-cols-2 gap-2 lg:grid-cols-1" aria-label="Dashboard">
                <a class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700" href="<?= XssMiddleware::escape(appUrl('/dashboard')) ?>">Tong quan</a>
                <a class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700" href="<?= XssMiddleware::escape(appUrl('/duan')) ?>">Du an</a>
                <a class="rounded-lg bg-blue-50 px-3 py-3 text-sm font-semibold text-blue-700" href="<?= XssMiddleware::escape(appUrl('/duan/them')) ?>">Them du an moi</a>
                <a class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700" href="<?= XssMiddleware::escape(appUrl('/login')) ?>" id="logoutLink">Dang xuat</a>
            </nav>
        </aside>

        <section class="p-5 sm:p-7">
            <header class="rounded-lg border border-slate-200 bg-white p-5">
                <p class="text-xs font-bold uppercase tracking-[0.12em] text-blue-600">Du an</p>
                <h2 class="mt-2 text-2xl font-bold tracking-normal text-slate-950 sm:text-3xl">Them du an moi</h2>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    Nhap thong tin du an, ngay lam, ngay end, link GitHub va website de luu vao danh sach.
                </p>
            </header>

            <form id="projectForm" class="mt-5 grid gap-5 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="grid gap-4 lg:grid-cols-2">
                    <label class="grid gap-2">
                        <span class="text-sm font-bold text-slate-700">Ten du an</span>
                        <input class="rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="name" type="text" placeholder="Vi du: Website ban hang" required>
                    </label>

                    <label class="grid gap-2">
                        <span class="text-sm font-bold text-slate-700">Trang thai</span>
                        <select class="rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="status">
                            <option value="Dang lam">Dang lam</option>
                            <option value="Gan xong">Gan xong</option>
                            <option value="Hoan thanh">Hoan thanh</option>
                            <option value="Tam dung">Tam dung</option>
                        </select>
                    </label>
                </div>

                <label class="grid gap-2">
                    <span class="text-sm font-bold text-slate-700">Mo ta</span>
                    <textarea class="min-h-28 rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="description" placeholder="Mo ta ngan gon ve du an"></textarea>
                </label>

                <div class="grid gap-4 lg:grid-cols-2">
                    <label class="grid gap-2">
                        <span class="text-sm font-bold text-slate-700">Ngay lam</span>
                        <input class="rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="start_date" type="date">
                    </label>

                    <label class="grid gap-2">
                        <span class="text-sm font-bold text-slate-700">Ngay end</span>
                        <input class="rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="end_date" type="date">
                    </label>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <label class="grid gap-2">
                        <span class="text-sm font-bold text-slate-700">GitHub link</span>
                        <input class="rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="github" type="url" placeholder="https://github.com/...">
                    </label>

                    <label class="grid gap-2">
                        <span class="text-sm font-bold text-slate-700">Website</span>
                        <input class="rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="website" type="url" placeholder="https://...">
                    </label>
                </div>

                <div class="grid gap-4 lg:grid-cols-[1fr_180px]">
                    <label class="grid gap-2">
                        <span class="text-sm font-bold text-slate-700">Cong nghe</span>
                        <input class="rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="stack" type="text" placeholder="PHP, MySQL, TailwindCSS">
                    </label>

                    <label class="grid gap-2">
                        <span class="text-sm font-bold text-slate-700">Tien do (%)</span>
                        <input class="rounded-md border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100" name="progress" type="number" min="0" max="100" value="0">
                    </label>
                </div>

                <div class="flex flex-col gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:items-center sm:justify-between">
                    <p id="projectMessage" class="text-sm font-semibold text-slate-600"></p>
                    <div class="flex gap-3">
                        <a class="inline-flex items-center justify-center rounded-md border border-slate-300 px-4 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50" href="<?= XssMiddleware::escape(appUrl('/duan')) ?>">Huy</a>
                        <button class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-3 text-sm font-bold text-white transition hover:bg-blue-700" type="submit">Luu du an</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>

<script src="<?= XssMiddleware::escape(appUrl('/assets/js/add-project.js')) ?>"></script>

<?php require_once __DIR__ . '/footer.php'; ?>
