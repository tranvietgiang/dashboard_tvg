const projectToken = localStorage.getItem('dashboard_token');
const projectAppBaseUrl = document.querySelector('meta[name="app-url"]')?.content || '';
const projectJoinUrl = (baseUrl, path) => `${baseUrl.replace(/\/$/, '')}/${path.replace(/^\//, '')}`;

if (!projectToken) {
    window.location.href = projectJoinUrl(projectAppBaseUrl, '/login');
}

const projectLogoutLink = document.getElementById('logoutLink');
if (projectLogoutLink) {
    projectLogoutLink.addEventListener('click', () => {
        localStorage.removeItem('dashboard_token');
        localStorage.removeItem('dashboard_user');
    });
}
