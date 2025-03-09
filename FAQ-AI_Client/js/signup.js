
import UserModel from './models/UserModel.js';
import UserSkeleton from './skeletons/UserSkeleton.js';
import { api_server } from '../universal.js';

document.addEventListener('DOMContentLoaded', () => {
    const signupForm = document.getElementById('signupForm');
    const fullNameInput = document.getElementById('fullName');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const messageDiv = document.getElementById('signupMessage');

    signupForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const fullName = fullNameInput.value;
        const username = usernameInput.value;
        const password = passwordInput.value;

        console.log(`Signup form submitted with fullName: ${fullName}, username: ${username}, password: ${password}`);

        const newUser = new UserModel(null, fullName, username, password);
        console.log('New UserModel created:', newUser);

        try {
            console.log('Calling UserSkeleton.create with newUser:', newUser);
            const userData = {
              fullName: fullName,
              username: username,
              password: password
            };
            const registrationSuccessful = await UserSkeleton.create(userData);
            console.log('UserSkeleton.create returned:', registrationSuccessful);
            if (registrationSuccessful) {
                console.log('Registration was successful.');
                messageDiv.textContent = 'Registration successful!';
                messageDiv.className = 'success-message';
                // Redirect to login (index.html) after a delay of 3 seconds
                setTimeout(() => {
                    window.location.href = 'index.html';
                }, 3000);
            } else {
                console.log('Registration failed.');
                messageDiv.textContent = 'Registration failed. Please try again.';
                messageDiv.className = 'error-message';
            }
        } catch (error) {
            console.error('Registration error:', error);
            messageDiv.textContent = `Registration failed: ${error.message}`;
            messageDiv.className = 'error-message';
        }
    });
});