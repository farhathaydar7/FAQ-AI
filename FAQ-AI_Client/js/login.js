
import UserSkeleton from './skeletons/UserSkeleton.js';
import { api_server } from '../universal.js';

document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const messageDiv = document.getElementById('loginMessage');

        const username = usernameInput.value;
        const password = passwordInput.value;

        try {
            const loginSuccessful = await UserSkeleton.login(username, password);
            if (loginSuccessful) {
                messageDiv.textContent = 'Login successful!';
                messageDiv.className = 'success-message';
                window.location.href = 'home.html';
            } else {
                messageDiv.textContent = 'Login failed. Please check your credentials.';
                messageDiv.className = 'error-message';
            }
        } catch (error) {
            console.error('Login error:', error);
            messageDiv.textContent = 'Login failed due to a network error.';
            messageDiv.className = 'error-message';
        }
    });
});