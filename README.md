# FAQ-AI - Frequently Asked Questions AI

## Overview

FAQ-AI is a web application designed to provide a platform for frequently asked questions and answers. It consists of a client-side interface for users to browse FAQs and a server-side component to manage and serve the FAQ content.

## Features

- **Browse FAQs:** Users can easily navigate and find answers to common questions.
- **Search Functionality:**  (To be implemented) Users will be able to search for specific questions or keywords.
- **Client-Server Architecture:** The application is built with a clear separation between the frontend (client) and backend (server) components.

## Technologies Used

- **Client (FAQ-AI_Client):**
    - HTML, CSS, JavaScript for frontend development.
    - Axios for making HTTP requests to the server.
- **Server (FAQ-AI_Server):**
    - PHP for backend logic and API development.
    - MySQL for database management.

## Project Structure

```
FAQ-AI/
├── FAQ-AI_Client/     # Client-side application files
│   ├── universal.js    # Universal JavaScript code
│   ├── assets/         # Assets like images, icons
│   ├── css/            # CSS stylesheets
│   ├── html/           # HTML files for different pages
│   ├── js/             # JavaScript files, including models and skeletons
│   └── ...
├── FAQ-AI_Server/     # Server-side application files
│   ├── universal.php   # Universal PHP code
│   ├── Database/       # Database related files (schema, migrations)
│   ├── models/         # Data models for FAQs and Users
│   ├── skeletons/      # Skeleton files (likely for data structures)
│   └── V1/             # API version 1 endpoints (addq, getq, searchq, etc.)
├── README.md           # Project description and setup instructions (this file)
└── .gitignore          # Git ignore file
```

## Setup Instructions

1. **Database Setup:**
   - Create a new database for FAQ-AI.
   - Import the database schema from `FAQ-AI/FAQ-AI_Server/Database/Database_schema.sql`.
   - Configure database credentials in `FAQ-AI/FAQ-AI_Server/V1/config.php`.

2. **Server Setup:**
   - Ensure PHP is installed and configured on your server.
   - Place the `FAQ-AI_Server` directory in your web server's document root or a suitable location.
   - Verify that the server can access the database.

3. **Client Setup:**
   - The `FAQ-AI_Client` directory contains the frontend files.
   - You can directly open the HTML files in your browser to run the client application.
   - For development, you might want to set up a local development server.

## API Endpoints (FAQ-AI_Server/V1/)

- `/addq.php`:  Endpoint to add a new FAQ.
- `/getq.php`:  Endpoint to retrieve FAQs.
- `/login.php`: Endpoint for user login.
- `/register.php`: Endpoint for user registration.
- `/searchq.php`: Endpoint to search FAQs.

## Further Development

- Implement search functionality on the client and server side.
- Develop an admin interface for FAQ management.
- Add user authentication and authorization.
- Improve the frontend UI/UX.

## License

[To be added]

---

This README.md provides a basic overview of the FAQ-AI project. For more detailed information, please refer to the code and specific files.