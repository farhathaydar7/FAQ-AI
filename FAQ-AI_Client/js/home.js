import { api_server } from '../universal.js';

class FaqModel {
    constructor(id, question, answer) {
        this.id = id;
        this.question = question;
        this.answer = answer;
    }

    static async getAll() {
        try {
            const response = await axios.get(`${api_server}/V1/getq.php`);
            return response.data.map(faq => new FaqModel(
                parseInt(faq.id),  // Convert string ID to number
                faq.question,
                faq.answer
            ));
        } catch (error) {
            console.error('Error fetching FAQs:', error);
            return [];
        }
    }

    static async search(query) {
        try {
            const response = await axios.get(`${api_server}/V1/searchq.php`, {
                params: { query }
            });
            return response.data.map(faq => new FaqModel(
                parseInt(faq.id),  // Convert string ID to number
                faq.question,
                faq.answer
            ));
        } catch (error) {
            console.error('Error searching FAQs:', error);
            return [];
        }
    }
}

class FaqApp {
    constructor() {
        this.faqList = document.getElementById('faqList');
        this.searchInput = document.getElementById('searchInput');
        this.initialize();
    }

    async initialize() {
        try {
            const faqs = await FaqModel.getAll();
            this.renderFaqs(faqs);
            this.setupEventListeners();
        } catch (error) {
            this.showError('Failed to load FAQs. Please try again later.');
        }
    }

    setupEventListeners() {
        // FAQ toggle
        this.faqList.addEventListener('click', (e) => {
            if (e.target.classList.contains('faq-question')) {
                const answer = e.target.nextElementSibling;
                answer.classList.toggle('visible');
            }
        });

        // Debounced search (300ms)
        let timeout;
        this.searchInput.addEventListener('input', (e) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                this.handleSearch(e.target.value.trim());
            }, 300);
        });
    }

    async handleSearch(query) {
        try {
            const results = query.length >= 2  // Minimum 2 characters for search
                ? await FaqModel.search(query)
                : await FaqModel.getAll();
                
            this.renderFaqs(results);
        } catch (error) {
            this.showError('Failed to search FAQs. Please try again.');
        }
    }

    renderFaqs(faqs) {
        this.faqList.innerHTML = faqs.length > 0
            ? faqs.map(faq => `
                <div class="faq-item" data-id="${faq.id}">
                    <h3 class="faq-question">${faq.question}</h3>
                    <div class="faq-answer">${faq.answer}</div>
                </div>
            `).join('')
            : '<div class="no-results">No matching FAQs found</div>';
    }

    showError(message) {
        this.faqList.innerHTML = `
            <div class="error-message">
                ${message}
            </div>
        `;
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => new FaqApp());