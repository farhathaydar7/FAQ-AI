import UserModel from './UserModel.js';
import UserSkeleton from './skeletons/UserSkeleton.js';
import { api_server } from '../universal.js';

document.addEventListener('DOMContentLoaded', () => {
    const signupForm = document.getElementById('signupForm');

    signupForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const fullNameInput = document.getElementById('fullName');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const messageDiv = document.getElementById('signupMessage');

        const fullName = fullNameInput.value;
        const username = usernameInput.value;
        const password = passwordInput.value;

        const newUser = new UserModel(null, fullName, username, password);

        try {
            const registrationSuccessful = await UserSkeleton.create(newUser, api_server);
            if (registrationSuccessful) {
                messageDiv.textContent = 'Registration successful!';
                messageDiv.className = 'success-message';
                // i should add redirection to login (index.html)
            } else {
                messageDiv.textContent = 'Registration failed. Please try again.';
                messageDiv.className = 'error-message';
            }
        } catch (error) {
            console.error('Registration error:', error);
            messageDiv.textContent = 'Registration failed due to a network error.';
            messageDiv.className = 'error-message';
        }
    });
});