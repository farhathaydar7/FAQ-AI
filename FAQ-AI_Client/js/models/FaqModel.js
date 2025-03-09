import axios from '../axios.min';

class FaqModel {
    constructor(id, question, answer) {
        this.id = id;
        this.question = question;
        this.answer = answer;
    }

    toJSON() {
        return {
            id: this.id,
            question: this.question,
            answer: this.answer
        };
    }

    static fromJSON(json) {
        return new FaqModel(json.id, json.question, json.answer);
    }

    static async getAll() {
        try {
            const response = await axios.get('/V1/getq.php');
            if (response.status < 200 || response.status >= 300) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.data.map(faq => FaqModel.fromJSON(faq));
        } catch (error) {
            console.error('Error fetching FAQs:', error);
            return [];
        }
    }

    static async search(query) {
        try {
            const response = await axios.get(`/V1/searchq.php?query=${encodeURIComponent(query)}`);
            return response.data.map(faq => FaqModel.fromJSON(faq));
        } catch (error) {
            console.error('Error searching FAQs:', error);
            return [];
        }
    }
}

export default FaqModel;