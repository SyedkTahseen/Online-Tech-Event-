# Online Tech Event Registration System

## Overview
The Online Tech Event Registration System is a web-based platform designed to facilitate the organization, management, and participation in technical events. Built for Techblaze and TechFest 2025, this system provides a seamless experience for event organizers and attendees. It includes features such as event registration, event browsing, team and faculty showcases, and a contact form for inquiries. The platform is responsive, user-friendly, and styled with a modern, tech-inspired design.

## Features
- **Event Listings**: Browse upcoming events like AI & Machine Learning Conference, Cybersecurity Workshop, and Blockchain Summit.
- **Event Registration**: Users can register for events with a single click, with redirection to the registration page.
- **Responsive Design**: Optimized for mobile, tablet, and desktop devices with media queries.
- **Interactive UI**: Hover effects, animations, and scroll-based visibility for a dynamic user experience.
- **Team Showcase**: Highlights the development team with animated cards.
- **Testimonials**: Displays feedback from participants and partners.
- **Contact Form**: Allows users to submit queries, integrated with a PHP backend for database storage.
- **Smooth Animations**: Fade-in effects, hover scaling, and gradient animations for visual appeal.

## Tech Stack
- **Frontend**:
  - HTML5: For structuring the web pages.
  - CSS3: For styling, including media queries for responsiveness and animations.
  - JavaScript: For interactivity, such as hover effects, scroll animations, and button click handlers.
- **Backend**:
  - PHP: Handles form submissions and database interactions.
- **Database**:
  - MySQL: Stores contact form submissions (assumed, as per `submit.php`).
- **Fonts**:
  - Google Fonts: Orbitron and Poppins for a futuristic and clean look.
- **Tools**:
  - XAMPP: Local development environment (visible from file paths and `submit.php`).

## Project Structure
- `about.html`: About page with details on Techblaze, upcoming events, team, testimonials, and more.
- `header.html`: Header section with navigation, event showcase, faculty, location, and footer.
- `contact.html`: Contact page with address, phone, email, and a query submission form.
- `submit.php`: PHP script to handle contact form submissions and store them in a MySQL database.
- `script.js`: JavaScript file for interactivity, including hover effects, scroll animations, and page load animations.
- `styles.css`: CSS file for styling the entire website, including responsive design and animations.
- Additional files in the directory (e.g., `register.html`, `work.html`) are referenced but not provided.

## Installation and Setup
1. **Prerequisites**:
   - XAMPP (or any Apache server with PHP and MySQL support).
   - A web browser (e.g., Chrome, as seen in the file type "Chrome HTML Document").

2. **Steps**:
   - Clone or download the project files to your local machine.
   - Place the project folder in the `htdocs` directory of your XAMPP installation (e.g., `C:\xampp\htdocs\event`).
   - Start the XAMPP control panel and ensure Apache and MySQL services are running.
   - Create a MySQL database named `workshop_registration`:
     ```sql
     CREATE DATABASE workshop_registration;
     USE workshop_registration;
     CREATE TABLE contact_form (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         email VARCHAR(255) NOT NULL,
         message TEXT NOT NULL,
         submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```
   - Update the database connection details in `submit.php` if necessary (e.g., if your MySQL user or password is different).
   - Open a browser and navigate to `http://localhost/event/header.html` to view the homepage.

## Usage
- **Homepage (`header.html`)**: Browse featured events, meet the faculty, and explore the location of Puducherry Technological University.
- **About Page (`about.html`)**: Learn about Techblaze, view upcoming events, meet the team, and read testimonials.
- **Contact Page (`contact.html`)**: Submit inquiries via the contact form, which are stored in the database.
- **Event Registration**: Click "Register Now" buttons to be redirected to the registration section (currently linked to `header.html#eventShowcase`).
- **Responsive Design**: The website adjusts automatically for different screen sizes, ensuring a smooth experience on mobile devices.


## Future Improvements
- Add user authentication for event organizers and attendees.
- Implement a full event registration system with payment integration.
- Add a backend dashboard for event management.
- Include more interactive features like live chat during events.
- Enhance accessibility (e.g., ARIA labels, keyboard navigation).

## Known Issues
- The video in `about.html` lacks a source (`<video>` tag has no `src` attribute).
- The `submit.php` script assumes a database named `workshop_registration`, which may not exist unless manually created.
- Some links (e.g., "Register Now" buttons) redirect to `header.html#eventShowcase`, which may not be the intended registration page.
- Image sources in `styles.css` and HTML files are missing (e.g., event card images, team member images).

## License
© 2025 Technical Event Management System | All Rights Reserved

## Contributors
- **Syed Khizr Tahseen** (IT)
- **T. Daranish** (IT)
- **Adarsh** (IT)
