import FaqModel from './FaqModel.js';
import axios from '../axios.min.js';

class FaqSkeleton {
    static async create(faqModel) {
        try {
            const response = await axios.post('/V1/addq.php', faqModel.toJSON(), {
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            return response.data.success;
        } catch (error) {
            console.error('Error creating FAQ:', error);
            return false;
        }
    }
    static async search(query) {
        try {
            const response = await axios.get(`/V1/searchq.php?query=${encodeURIComponent(query)}`, {
                headers: {
                    'Accept': 'application/json',
                }
            });
            return response.data.map(faq => FaqModel.fromJSON(faq));
        } catch (error) {
            console.error('Error searching FAQs:', error);
            return [];
        }
    }
    static async findById(id) {
        try {
            const response = await axios.get(`/V1/getq.php?id=${encodeURIComponent(id)}`);
            return FaqModel.fromJSON(response.data);
        } catch (error) {
            console.error('Error finding FAQ:', error);
            return null;
        }
    }

    static async getAll() {
        return FaqModel.getAll();
    }
}

export default FaqSkeleton;