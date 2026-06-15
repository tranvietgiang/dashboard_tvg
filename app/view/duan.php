<?php
$projects = [
    [
        'name' => 'Dashboard TVG',
        'description' => 'Bang dieu khien quan ly user, thong ke hoat dong va bao cao theo thang.',
        'start_date' => '2026-06-01',
        'end_date' => '2026-06-30',
        'github' => 'https://github.com/your-name/dashboard-tvg',
        'website' => 'https://dashboard.example.com',
        'status' => 'Dang lam',
        'progress' => 72,
        'stack' => ['PHP', 'MySQL', 'TailwindCSS', 'JavaScript'],
    ],
    [
        'name' => 'Portfolio Ca Nhan',
        'description' => 'Website gioi thieu ban than, ky nang, du an va thong tin lien he.',
        'start_date' => '2026-05-10',
        'end_date' => '2026-06-20',
        'github' => 'https://github.com/your-name/portfolio',
        'website' => 'https://portfolio.example.com',
        'status' => 'Gan xong',
        'progress' => 88,
        'stack' => ['HTML', 'TailwindCSS', 'JavaScript'],
    ],
    [
        'name' => 'Website Ban Hang',
        'description' => 'Trang ban hang co gio hang, quan ly san pham va lich su don hang.',
        'start_date' => '2026-04-15',
        'end_date' => '2026-07-15',
        'github' => 'https://github.com/your-name/shop-web',
        'website' => 'https://shop.example.com',
        'status' => 'Dang phat trien',
        'progress' => 54,
        'stack' => ['PHP', 'MySQL', 'TailwindCSS'],
    ],
];
?>

<?php require_once __DIR__ . '/header.php'; ?>

<main class="min-h-screen bg-slate-50 text-slate-900">
    <div class="grid min-h-screen grid-cols-1 lg:grid-cols-[240px_minmax(0,1fr)]">
        <aside class="border-b border-slate-200 bg-white p-5 lg:border-b-0 lg:border-r lg:p-7">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.12em] text-blue-600">Dashboard TVG</p>
                <h1 class="mt-2 text-2xl font-bold tracking-normal text-slate-950">Bang dieu khien</h1>
            </div>

            <nav class="mt-8 grid grid-cols-3 gap-2 lg:grid-cols-1" aria-label="Dashboard">
                <a class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700" href="<?= XssMiddleware::escape(appUrl('/dashboard')) ?>">Tong quan</a>
                <a class="rounded-lg bg-blue-50 px-3 py-3 text-sm font-semibold text-blue-700" href="<?= XssMiddleware::escape(appUrl('/duan')) ?>">Du an</a>
                <a class="rounded-lg px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700" href="<?= XssMiddleware::escape(appUrl('/login')) ?>" id="logoutLink">Dang xuat</a>
            </nav>
        </aside>

        <section class="p-5 sm:p-7">
            <header class="flex flex-col gap-4 rounded-lg border border-slate-200 bg-white p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.12em] text-blue-600">Quan ly cong viec</p>
                    <h2 class="mt-2 text-2xl font-bold tracking-normal text-slate-950 sm:text-3xl">Du an dang lam</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                        Theo doi ngay bat dau, ngay ket thuc, link GitHub, website demo va tien do tung du an.
                    </p>
                </div>
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700">
                    <?= count($projects) ?> du an
                </div>
            </header>

            <section class="mt-5 grid gap-4 xl:grid-cols-3">
                <?php foreach ($projects as $project): ?>
                    <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-bold tracking-normal text-slate-950">
                                    <?= XssMiddleware::escape($project['name']) ?>
                                </h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    <?= XssMiddleware::escape($project['description']) ?>
                                </p>
                            </div>
                            <span class="shrink-0 rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">
                                <?= XssMiddleware::escape($project['status']) ?>
                            </span>
                        </div>

                        <dl class="mt-5 grid gap-3 text-sm">
                            <div class="flex items-center justify-between gap-4 rounded-md bg-slate-50 px-3 py-2">
                                <dt class="font-semibold text-slate-500">Ngay lam</dt>
                                <dd class="font-bold text-slate-800"><?= XssMiddleware::escape($project['start_date']) ?></dd>
                            </div>
                            <div class="flex items-center justify-between gap-4 rounded-md bg-slate-50 px-3 py-2">
                                <dt class="font-semibold text-slate-500">Ngay end</dt>
                                <dd class="font-bold text-slate-800"><?= XssMiddleware::escape($project['end_date']) ?></dd>
                            </div>
                        </dl>

                        <div class="mt-5">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-semibold text-slate-500">Tien do</span>
                                <span class="font-bold text-slate-900"><?= (int) $project['progress'] ?>%</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-slate-100">
                                <div class="h-2 rounded-full bg-blue-600" style="width: <?= (int) $project['progress'] ?>%"></div>
                            </div>
                        </div>

                        <div class="mt-5 flex flex-wrap gap-2">
                            <?php foreach ($project['stack'] as $tech): ?>
                                <span class="rounded-md border border-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                    <?= XssMiddleware::escape($tech) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <a class="inline-flex items-center justify-center rounded-md border border-slate-300 px-3 py-2 text-sm font-bold text-slate-700 transition hover:bg-slate-50" href="<?= XssMiddleware::escape($project['github']) ?>" target="_blank" rel="noopener noreferrer">
                                GitHub
                            </a>
                            <a class="inline-flex items-center justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-bold text-white transition hover:bg-blue-700" href="<?= XssMiddleware::escape($project['website']) ?>" target="_blank" rel="noopener noreferrer">
                                Website
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </section>
    </div>
</main>

<script src="<?= XssMiddleware::escape(appUrl('/assets/js/projects.js')) ?>"></script>

<?php require_once __DIR__ . '/footer.php'; ?>
