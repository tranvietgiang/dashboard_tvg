const loginForm = document.getElementById('loginForm');
const loginMessage = document.getElementById('loginMessage');

if (loginForm) {
    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        loginMessage.classList.remove('hidden');
        loginMessage.textContent = 'Dang dang nhap...';

        try {
            const response = await fetch(loginForm.action, {
                method: 'POST',
                body: new FormData(loginForm),
                headers: {
                    Accept: 'application/json',
                },
            });
            const result = await response.json();

            if (!response.ok || !result.success) {
                loginMessage.textContent = result.message || 'Dang nhap that bai';
                return;
            }

            localStorage.setItem('dashboard_token', result.token);
            localStorage.setItem('dashboard_user', JSON.stringify(result.user));
            window.location.href = '/dashboard';
        } catch (error) {
            loginMessage.textContent = 'Khong the ket noi may chu';
        }
    });
}
