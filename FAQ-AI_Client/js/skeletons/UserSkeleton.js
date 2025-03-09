import axios from '../js/axios.min.js';
import UserModel from '../js/models/UserModel.js';

class UserSkeleton {
    constructor() {}

    static async login(username, password) {
        const formData = new URLSearchParams();
        formData.append('username', username);
        formData.append('password', password);

        const response = await axios.post(api_server + '/V1/login.php', formData, {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        });

        if (response.status < 200 || response.status >= 300) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        try {
            const data = response.data;
            if (data.status === 'success') {
                return true; // Login successful
            } else {
                console.error('Login failed:', data.message);
                return false; // Login failed
            }
        } catch (error) {
            console.error('Error parsing JSON response:', error);
            return false; // Login failed due to error
        }
    }


    static async findByUsername(username) {
        const response = await axios.post(api_server + '/V1/login.php', `username=${encodeURIComponent(username)}`, {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        });

        if (response.status !== 200) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const text = JSON.stringify(response.data);
        if (text.startsWith('User not found.')) {
            return null;
        }

        try {
            const data = response.data;
            return new UserModel(data.id, data.fullName, data.username, null); // Password should not be exposed
        } catch (e) {
            console.error('Could not parse response as JSON: ', text);
            return null;
        }
    }

    static async create(userModel) {
        const formData = new URLSearchParams();
        formData.append('fullName', userModel.getFullName());
        formData.append('username', userModel.getUsername());
        formData.append('password', userModel.getPassword());

        const response = await axios.post(api_server + '/V1/register.php', formData, {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        try {
            const data = await response.json(); // Expecting JSON response from register.php
            if (data.status === 'success') {
                return true; // Registration successful
            } else {
                console.error('Registration failed:', data.message);
                return false; // Registration failed
            }
        } catch (error) {
            console.error('Error parsing JSON response:', error);
            return false; // Registration failed due to error
        }
    }
}

export default UserSkeleton;