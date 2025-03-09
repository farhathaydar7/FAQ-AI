import { api_server } from '../universal.js';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('addFaqForm');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const question = document.getElementById('question').value;
        const answer = document.getElementById('answer').value;

        try {
            const formData = new FormData();
            formData.append('question', question);
            formData.append('answer', answer);

            const response = await axios.post(`${api_server}/V1/addq.php`, formData);

            if (response.data.message) {
                alert('FAQ added successfully!');
                window.location.href = 'home.html'; // Redirect to home page
            } else {
                alert('Failed to add FAQ. Please try again.');
                console.error('Error adding FAQ:', response.data.message);
            }
        } catch (error) {
            alert('An error occurred while adding the FAQ.');
            console.error('Error adding FAQ:', error);
        }
    });
});