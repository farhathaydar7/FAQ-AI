import FaqModel from '../models/FaqModel.js';
import axios from '../js/axios.min.js';

class FaqSkeleton {
    constructor() {}

    static async create(faqModel) {
        const formData = new URLSearchParams();
        formData.append('question', faqModel.getQuestion());
        formData.append('answer', faqModel.getAnswer());

        const response = await axios.post('V1/addq.php', formData, { // Assuming addq.php handles FAQ creation
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        });

        if (response.status < 200 || response.status >= 300) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const text = response.data;
        // Assuming server returns 'FAQ created successfully' or similar on success
        return text.startsWith('FAQ created successfully'); // Adjust based on actual server response
    }

    static async findById(id) {
        const response = await axios.get(`V1/getq.php?id=${encodeURIComponent(id)}`); // Assuming getq.php can fetch by ID

        if (response.status < 200 || response.status >= 300) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const text = response.data;
        if (text.startsWith('FAQ not found')) { // Adjust based on actual server response if not found
            return null;
        }

        try {
            const data = JSON.parse(text);
            return new FaqModel(data.id, data.question, data.answer);
        } catch (e) {
            console.error('Could not parse response as JSON: ', text);
            return null;
        }
    }

    static async getAll() {
        const response = await axios.get('V1/getq.php'); // Fetching all FAQs - adjust endpoint if needed

        if (response.status < 200 || response.status >= 300) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const text = response.data;
        try {
            const data = JSON.parse(text);
            return data.map(faqData => new FaqModel(faqData.id, faqData.question, faqData.answer));
        } catch (e) {
            console.error('Could not parse response as JSON: ', text);
            return [];
        }
    }

    // Update and delete functionalities would be added similarly,
    // assuming corresponding server-side endpoints exist.
}

export default FaqSkeleton;