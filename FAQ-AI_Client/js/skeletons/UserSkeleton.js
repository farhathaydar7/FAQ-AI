
import UserModel from '../models/UserModel.js';
import { api_server } from '../../universal.js';

class UserSkeleton {
    constructor() {}

    static async login(username, password) {
        const userData = {
            username: username,
            password: password
        };

        console.log('Sending login request to server:', userData);

        const response = await axios.post(api_server + '/V1/login.php', JSON.stringify(userData), {
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (response.status < 200 || response.status >= 300) {
            console.error(`HTTP error! status: ${response.status}`);
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        try {
            const data = response.data;
            console.log('Login response data:', data);
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
        const response = await axios.get(api_server + '/V1/get_user.php', {
            params: {
                username: username
            }
        });

        if (response.status < 200 || response.status >= 300) {
            console.error(`HTTP error! status: ${response.status}`);
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = response.data;
        console.log('FindByUsername response data:', data);
        if (data.status === 'error' && data.message === 'User not found.') {
            return null;
        }

        try {
            return new UserModel(data.id, data.fullName, data.username, null); // Password should not be exposed
        } catch (e) {
            console.error('Could not parse response as JSON: ', data);
            return null;
        }
    }

    static async create(userModel) {
        console.log('Sending registration request to server:', userModel);
        
        const userData = {
            fullName: userModel.fullName,
            username: userModel.username,
            password: userModel.password
        };

        const response = await axios.post(api_server + '/V1/register.php', JSON.stringify(userData), {
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (response.status < 200 || response.status >= 300) {
            console.error(`HTTP error! status: ${response.status}`);
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        try {
            const data = response.data;
            console.log('Registration response data:', data);
            if (data.status === 'success') {
                return true; // Registration successful
            } else {
                console.error('Registration failed:', data.message);
                return false; // Registration failed
            }
        } catch (error) {
            console.error('Error parsing text response:', error);
            return false; // Registration failed due to error
        }
    }
}

export default UserSkeleton;