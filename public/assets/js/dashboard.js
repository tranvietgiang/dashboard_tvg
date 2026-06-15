const token = localStorage.getItem('dashboard_token');
const monthNames = ['Thang 1', 'Thang 2', 'Thang 3', 'Thang 4', 'Thang 5', 'Thang 6', 'Thang 7', 'Thang 8', 'Thang 9', 'Thang 10', 'Thang 11', 'Thang 12'];

const formatMonth = (month) => {
    if (!month) {
        return '--';
    }

    const monthNumber = Number(month.month_number);
    return `${monthNames[monthNumber - 1] || month.month_key}/${month.year_number}`;
};

const setText = (id, value) => {
    const element = document.getElementById(id);
    if (element) {
        element.textContent = value;
    }
};

const escapeHtml = (value) => String(value ?? '')
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#039;');

const renderChart = (months) => {
    const chart = document.getElementById('activityChart');
    if (!chart) {
        return;
    }

    if (!months.length) {
        chart.innerHTML = '<p class="empty-state">Chua co hoat dong nao.</p>';
        return;
    }

    const maxTotal = Math.max(...months.map((month) => Number(month.total)));
    chart.innerHTML = months.map((month) => {
        const total = Number(month.total);
        const height = Math.max(12, Math.round((total / maxTotal) * 150));

        return `
            <div class="chart-item">
                <div class="chart-bar-wrap">
                    <span class="chart-value">${total}</span>
                    <div class="chart-bar" style="height:${height}px"></div>
                </div>
                <span class="chart-label">${formatMonth(month)}</span>
            </div>
        `;
    }).join('');
};

const renderActivities = (activities) => {
    const list = document.getElementById('activityList');
    if (!list) {
        return;
    }

    if (!activities.length) {
        list.innerHTML = '<p class="empty-state">Chua co lich su hoat dong.</p>';
        return;
    }

    list.innerHTML = activities.map((activity) => `
        <div class="activity-row">
            <div>
                <strong>${escapeHtml(activity.action)}</strong>
                <p>${escapeHtml(activity.description || 'Khong co mo ta')}</p>
            </div>
            <time>${escapeHtml(activity.created_at)}</time>
        </div>
    `).join('');
};

const loadDashboard = async () => {
    if (!token) {
        window.location.href = '/login';
        return;
    }

    const response = await fetch('/api/dashboard-stats', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${token}`,
        },
    });
    const result = await response.json();

    if (!response.ok || !result.success) {
        localStorage.removeItem('dashboard_token');
        window.location.href = '/login';
        return;
    }

    const stats = result.data;
    const user = stats.user || {};
    const months = stats.activity_by_month || [];

    setText('userName', user.name || 'User');
    setText('userEmail', user.email || '');
    setText('userRole', user.role || 'user');
    setText('totalActivities', stats.total_activities || 0);
    setText('activeMonths', months.length);
    setText('bestMonth', formatMonth(stats.best_month));
    setText('bestMonthText', stats.best_month ? `${stats.best_month.total} hoat dong trong thang nay.` : 'Chua co du lieu hoat dong.');
    setText('chartSummary', stats.best_month ? `Cao nhat: ${formatMonth(stats.best_month)}` : 'Chua co du lieu');

    renderChart(months);
    renderActivities(stats.recent_activities || []);
};

const logoutLink = document.getElementById('logoutLink');
if (logoutLink) {
    logoutLink.addEventListener('click', () => {
        localStorage.removeItem('dashboard_token');
        localStorage.removeItem('dashboard_user');
    });
}

loadDashboard();
