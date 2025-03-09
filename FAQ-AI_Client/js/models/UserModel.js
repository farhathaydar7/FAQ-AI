import axios from '../axios.min.js';
import { api_server } from '../../universal.js';
 
class UserModel {

    constructor(id, fullName, username, password) {
        this.id = id;
        this.fullName = fullName;
        this.username = username;
        this.password = password; 
    }

    getId() {
        return this.id;
    }

    getFullName() {
        return this.fullName;
    }

    getUsername() {
        return this.username;
    }

    getPassword() {
        return this.password; 
    }

    setFullName(fullName) {
        this.fullName = fullName;
    }

    setUsername(username) {
        this.username = username;
    }

    setPassword(password) {
        this.password = password;
    }


    static async create(user) {
        try {
            const response = await axios.post(api_server + '/V1/register.php', user, {
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const userData = response.data;
            return new UserModel(userData.id, userData.fullName, userData.username, userData.password);
        } catch (error) {
            console.error('Error creating user:', error);
            return null; 
        }
    }
}

export default UserModel;