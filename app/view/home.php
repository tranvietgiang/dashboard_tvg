<?php require_once __DIR__ . '/header.php'; ?>

<main class="dashboard-shell">
    <aside class="dashboard-sidebar">
        <div>
            <p class="dashboard-kicker">Dashboard TVG</p>
            <h1>Bang dieu khien</h1>
        </div>
        <nav class="dashboard-nav" aria-label="Dashboard">
            <a href="/dashboard" class="active">Tong quan</a>
            <a href="/login" id="logoutLink">Dang xuat</a>
        </nav>
    </aside>

    <section class="dashboard-main">
        <header class="dashboard-header">
            <div>
                <p class="dashboard-kicker">Xin chao</p>
                <h2 id="userName">Dang tai du lieu...</h2>
                <p id="userEmail">Kiem tra phien dang nhap cua ban.</p>
            </div>
            <div class="dashboard-badge" id="userRole">User</div>
        </header>

        <section class="dashboard-grid">
            <article class="metric-card">
                <span>Tong hoat dong</span>
                <strong id="totalActivities">0</strong>
                <p>Tat ca hoat dong da ghi nhan.</p>
            </article>

            <article class="metric-card">
                <span>Thang nhieu nhat</span>
                <strong id="bestMonth">--</strong>
                <p id="bestMonthText">Chua co du lieu hoat dong.</p>
            </article>

            <article class="metric-card">
                <span>So thang co du lieu</span>
                <strong id="activeMonths">0</strong>
                <p>Cac thang user co phat sinh hoat dong.</p>
            </article>
        </section>

        <section class="dashboard-panel">
            <div class="panel-heading">
                <div>
                    <p class="dashboard-kicker">Thong ke</p>
                    <h3>Hoat dong theo thang</h3>
                </div>
                <span id="chartSummary">Dang tai...</span>
            </div>
            <div class="activity-chart" id="activityChart" aria-label="Bieu do hoat dong theo thang"></div>
        </section>

        <section class="dashboard-panel">
            <div class="panel-heading">
                <div>
                    <p class="dashboard-kicker">Gan day</p>
                    <h3>Lich su hoat dong</h3>
                </div>
            </div>
            <div class="activity-list" id="activityList"></div>
        </section>
    </section>
</main>

<script src="/assets/js/dashboard.js"></script>

<?php require_once __DIR__ . '/footer.php'; ?>
