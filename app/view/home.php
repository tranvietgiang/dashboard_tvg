<!DOCTYPE html>
<?php require_once __DIR__ . '/header.php'; ?>

<main class="db-shell">
    <!-- Mobile sidebar toggle -->
    <button class="theme-toggle db-sidebar-toggle" aria-label="Toggle navigation" onclick="document.querySelector('.db-sidebar').classList.toggle('open')">
        &#9776;
    </button>

    <aside class="db-sidebar" aria-label="Sidebar navigation">
        <div>
            <p class="dashboard-kicker">Dashboard TVG</p>
            <h1>Bang điều khiển</h1>
        </div>
        <nav class="db-nav">
            <a href="<?= XssMiddleware::escape(appUrl('/dashboard')) ?>" class="active">Tổng quan</a>
            <a href="<?= XssMiddleware::escape(appUrl('/duan')) ?>">Dự án</a>
            <a href="<?= XssMiddleware::escape(appUrl('/duan/them')) ?>">Thêm dự án mới</a>
            <a href="<?= XssMiddleware::escape(appUrl('/login')) ?>" id="logoutLink">Đăng xuất</a>
        </nav>
    </aside>

    <section class="db-main">
        <header class="db-header">
            <div>
                <p class="dashboard-kicker">Xin chào</p>
                <h2 id="userName" aria-live="polite">Đang tải dữ liệu...</h2>
                <p id="userEmail">Kiểm tra phiên đăng nhập của bạn.</p>
            </div>
            <div class="db-badge" id="userRole">User</div>
        </header>

        <section class="db-grid">
            <article class="db-card">
                <span>Tổng hoạt động</span>
                <strong id="totalActivities">0</strong>
                <p>Tất cả hoạt động đã ghi nhận.</p>
            </article>

            <article class="db-card">
                <span>Tháng nhiều nhất</span>
                <strong id="bestMonth">--</strong>
                <p id="bestMonthText">Chưa có dữ liệu hoạt động.</p>
            </article>

            <article class="db-card">
                <span>Số tháng có dữ liệu</span>
                <strong id="activeMonths">0</strong>
                <p>Các tháng người dùng có phát sinh hoạt động.</p>
            </article>
        </section>

        <section class="db-panel">
            <div class="panel-heading">
                <div>
                    <p class="dashboard-kicker">Thống kê</p>
                    <h3>Hoạt động theo tháng</h3>
                </div>
                <span id="chartSummary">Đang tải...</span>
            </div>
            <div class="activity-chart" id="activityChart" aria-label="Biểu đồ hoạt động theo tháng"></div>
        </section>

        <section class="db-panel">
            <div class="panel-heading">
                <div>
                    <p class="dashboard-kicker">Gần đây</p>
                    <h3>Lịch sử hoạt động</h3>
                </div>
            </div>
            <div class="activity-list" id="activityList"></div>
        </section>
    </section>
</main>

<script src="<?= XssMiddleware::escape(appUrl('/assets/js/dashboard.js')) ?>"></script>
<?php require_once __DIR__ . '/footer.php'; ?>
