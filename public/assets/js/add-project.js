const addProjectToken = localStorage.getItem('dashboard_token');
const addProjectAppBaseUrl = document.querySelector('meta[name="app-url"]')?.content || '';
const addProjectApiBaseUrl = document.querySelector('meta[name="api-base-url"]')?.content || '/api';
const addProjectJoinUrl = (baseUrl, path) => `${baseUrl.replace(/\/$/, '')}/${path.replace(/^\//, '')}`;

if (!addProjectToken) {
    window.location.href = addProjectJoinUrl(addProjectAppBaseUrl, '/login');
}

const addProjectForm = document.getElementById('projectForm');
const addProjectMessage = document.getElementById('projectMessage');

if (addProjectForm) {
    addProjectForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        addProjectMessage.textContent = 'Dang luu du an...';

        const formData = new FormData(addProjectForm);
        const payload = Object.fromEntries(formData.entries());

        try {
            const response = await fetch(addProjectJoinUrl(addProjectApiBaseUrl, '/projects'), {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${addProjectToken}`,
                },
                body: JSON.stringify(payload),
            });
            const result = await response.json();

            if (!response.ok || !result.success) {
                addProjectMessage.textContent = result.message || 'Khong luu duoc du an';
                return;
            }

            addProjectMessage.textContent = 'Da luu du an thanh cong';
            window.location.href = addProjectJoinUrl(addProjectAppBaseUrl, '/duan');
        } catch (error) {
            addProjectMessage.textContent = 'Khong the goi API them du an';
        }
    });
}

const addProjectLogoutLink = document.getElementById('logoutLink');
if (addProjectLogoutLink) {
    addProjectLogoutLink.addEventListener('click', () => {
        localStorage.removeItem('dashboard_token');
        localStorage.removeItem('dashboard_user');
    });
}
