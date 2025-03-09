import { api_server } from '../../universal.js';
import axios from '../axios.min.js';

class FaqModel {
    constructor(id, question, answer) {
        this.id = id;
        this.question = question;
        this.answer = answer;
    }

    getId() {
        return this.id;
    }

    getQuestion() {
        return this.question;
    }

    getAnswer() {
        return this.answer;
    }

    setId(id) {
        this.id = id;
    }

    setQuestion(question) {
        this.question = question;
    }

    setAnswer(answer) {
        this.answer = answer;
    }

    static async getAll() {
        try {
            const response = await axios(api_server + '/V1/getq.php');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const faqs = await response.json();
            return faqs.map(faq => new FaqModel(faq.id, faq.question, faq.answer));
        } catch (error) {
            console.error('Error fetching FAQs:', error);
            return []; // Return an empty array or handle error as needed
        }
    }
}

export default FaqModel;