# Abu Haneefah Islamic Academy — Website Documentation

**Prepared for:** Client Review  
**Date:** July 2026  
**Version:** 1.0  

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Technology Stack](#2-technology-stack)
3. [Pages & Features](#3-pages--features)
4. [Contact Form & Admin Dashboard](#4-contact-form--admin-dashboard)
5. [Design & User Experience](#5-design--user-experience)
6. [Responsive Design](#6-responsive-design)
7. [Deployment & Hosting](#7-deployment--hosting)
8. [Security](#8-security)
9. [Future Enhancements](#9-future-enhancements)
10. [Contact Information](#10-contact-information)

---

## 1. Project Overview

The **Abu Haneefah Islamic Academy** website is a modern, responsive web application built to represent the school online. It serves as an informational hub for prospective parents and students, showcasing the academy's mission, academic programs, admissions process, and campus life.

### Key Objectives

- **Online Presence** — Establish a professional, trustworthy digital presence for the academy.
- **Information Hub** — Provide comprehensive information about programs, admissions, and academics.
- **Lead Generation** — Capture enquiries from prospective parents through a contact form.
- **Message Management** — Allow school administrators to view and manage contact form submissions.
- **Mobile-First** — Deliver a seamless experience across all devices (phones, tablets, desktops).

---

## 2. Technology Stack

| Component | Technology | Purpose |
|---|---|---|
| **Backend Framework** | Laravel 12 (PHP 8.2) | Application logic, routing, database operations |
| **Frontend Styling** | Tailwind CSS 4 | Modern, responsive, utility-first styling |
| **Build Tool** | Vite 7 | Fast asset bundling and development server |
| **Database** | SQLite (default) / MySQL / PostgreSQL | Stores contact form submissions and session data |
| **Templating** | Blade | Server-side HTML rendering |
| **Deployment** | Docker + Apache | Containerized production deployment |
| **Fonts** | Google Fonts (Plus Jakarta Sans, Amiri) | English & Arabic typography |

---

## 3. Pages & Features

The website consists of **7 main pages**, each designed with a specific purpose:

### 3.1 Home Page (`/`)

The landing page introduces the academy with a full-screen hero section. It includes:

- **Hero Banner** — School name, tagline, and call-to-action buttons ("Apply Now" and "Contact Us").
- **About Summary** — Brief introduction with key highlights (Qur'an & Sunnah Based, Academic Excellence, Strong Community, Moral Uprightness).
- **Mission & Vision** — Presented in both English and Arabic.
- **Why Choose Us** — Six feature cards (Integrated Curriculum, Qualified Teachers, Moral Development, Multilingual Education, Safe Environment, Adult Classes).
- **Programs Overview** — Six academic programs (Comprehensive Arabic Class, Ibtidaiyah, Idaadiyah, Thanawiyah, Adult Arabic Class, Qur'an Memorization).
- **Facilities** — Prayer Hall, Classrooms, Library, Sports Ground.
- **Gallery Preview** — A snapshot of campus life with a link to the full gallery.
- **Testimonials** — Parent reviews and feedback.
- **FAQ Section** — Expandable answers to common questions.
- **Call to Action** — Encourages visitors to apply or contact the school.

### 3.2 About Page (`/about`)

Provides an in-depth look at the academy:

- **School History** — 15+ years of educational excellence, located in Ogun State, Nigeria.
- **Core Values** — Building Faith, Seeking Knowledge, Shaping Character, Serving Ummah.
- **Mission & Vision** — Detailed statements in English and Arabic.
- **Statistics** — 15+ years, 500+ students, 50+ teachers, 3 languages taught.

### 3.3 Admissions Page (`/admissions`)

Guides prospective parents through the enrollment process:

- **Admission Banner** — "Enroll Your Child Today!" with a direct apply link.
- **Admission Process** — Four-step guide: Inquiry → Application → Assessment → Enrollment.
- **Requirements** — Checklist of documents needed (admission form, birth certificate, report card, photographs, medical report, ID).
- **Programs Available** — All six programs with levels and descriptions.
- **Official Languages** — Arabic, English, and Yoruba.

### 3.4 Academics Page (`/academics`)

Details the curriculum and teaching approach:

- **Integrated Curriculum** — Explanation of how Islamic and contemporary education are combined.
- **Academic Programs** — Detailed breakdown of each level with key subjects:
  - Comprehensive Arabic Class (Foundation)
  - Ibtidaiyah (Primary)
  - Idaadiyah (Junior Secondary)
  - Thanawiyah (Senior Secondary)
- **Teaching Methodology** — Six pedagogical approaches (Qur'an-Centric Learning, Interactive Teaching, Small Class Sizes, Practical Application, Character Building, Multilingual Instruction).

### 3.5 Gallery Page (`/gallery`)

Showcases campus life through a masonry-style image grid:

- Classroom photos, student activities, Islamic architecture, admissions photos.
- **Lightbox Feature** — Click any image to view it full-screen with a darkened overlay.
- Smooth hover effects with image captions.

### 3.6 Contact Page (`/contact`)

The primary lead-capture page:

- **Contact Information Cards** — Email, phone, and physical address.
- **Social Media Links** — Facebook, Twitter, Instagram, WhatsApp.
- **Contact Form** — Fields for Name, Email, Phone, Subject, and Message with validation.
- **Success Confirmation** — Users receive a thank-you message after submission.
- **Google Maps Embed** — Interactive map showing the school's location.

### 3.7 Print-Friendly Contact Page (`/contact-print`)

A standalone, print-optimized version of the contact page designed for:
- Generating PDF previews of the contact information.
- Printing the school's contact details for offline distribution.

---

## 4. Contact Form & Admin Dashboard

### 4.1 Contact Form

The contact form is the primary lead-generation tool:

| Field | Type | Validation |
|---|---|---|
| Full Name | Text | Required, max 255 characters |
| Email Address | Email | Required, valid email format |
| Phone Number | Text | Required, max 20 characters |
| Subject | Text | Required, max 255 characters |
| Message | Textarea | Required |

- **CSRF Protection** — All form submissions are protected against cross-site request forgery.
- **Input Validation** — Server-side validation ensures data integrity.
- **Success Feedback** — Users see a confirmation message: *"Thank you for reaching out! Your message has been received. We will get back to you soon, Insha'Allah."*
- **Error Handling** — Validation errors are displayed inline with the respective fields.

### 4.2 Admin Dashboard (`/admin`)

A private administrative area for managing contact form submissions:

- **Messages Table** — Displays all submissions with name, email, phone, subject, date, and actions.
- **Pagination** — 10 messages per page for easy navigation.
- **View Message** — Click any message to see full details (name, email, phone, subject, message body, submission date/time).
- **Delete Message** — Remove messages with a confirmation prompt to prevent accidental deletion.
- **Empty State** — Displays a friendly "No Messages Yet" placeholder when the inbox is empty.
- **Quick Links** — Direct email and phone links from the dashboard.

---

## 5. Design & User Experience

### 5.1 Visual Identity

- **Color Palette** — Islamic green theme (primary greens from light `#f0fdf4` to deep `#022c12`) with gold accents.
- **Typography** — *Plus Jakarta Sans* for English text; *Amiri* for Arabic text.
- **Imagery** — High-quality photos of classrooms, students, and Islamic architecture.
- **Logo** — Custom academy logo displayed in the navbar and footer.

### 5.2 Interactive Elements

- **Scroll Animations** — Elements fade in and slide up as the user scrolls (using Intersection Observer API).
- **Hover Effects** — Cards lift, images zoom, and buttons shift on hover for tactile feedback.
- **Lightbox Gallery** — Full-screen image viewer with click-to-close and ESC key support.
- **Sticky Navbar** — Navigation bar transitions from transparent to solid white on scroll (home page).
- **Smooth Scrolling** — Native smooth scroll behavior throughout the site.

### 5.3 Navigation

- **Desktop** — Horizontal navigation bar with all pages and a prominent "Contact Us" button.
- **Mobile** — Hamburger menu that expands into a vertical list of links.
- **Footer** — Quick links, mission statement, and contact information on every page.

---

## 6. Responsive Design

The website is fully responsive and optimized for all screen sizes:

| Device | Breakpoint | Layout Adjustments |
|---|---|---|
| **Mobile** | < 640px | Single-column layout, hamburger menu, stacked cards |
| **Tablet** | 640px – 1024px | Two-column grids, visible table columns |
| **Desktop** | > 1024px | Full multi-column layouts, horizontal navigation |

- All images use responsive `object-cover` to maintain aspect ratios.
- Tables in the admin dashboard hide non-essential columns on smaller screens.
- Contact form switches from two-column to single-column on mobile.

---

## 7. Deployment & Hosting

### 7.1 Docker Deployment

The project includes a production-ready Docker setup:

- **Multi-Stage Build** — Frontend assets are built with Node.js, then copied into a PHP/Apache image.
- **Apache Configuration** — Custom virtual host config with rewrite rules and headers.
- **Entrypoint Script** — Automatically runs migrations and sets up storage permissions on container start.
- **PHP Extensions** — PDO (MySQL, PostgreSQL, SQLite), GD, Zip, MBString, and more.

### 7.2 Local Development

```bash
# Install PHP dependencies
composer install

# Install frontend dependencies
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Run database migrations
php artisan migrate

# Build frontend assets
npm run build

# Start development server
php artisan serve
```

A combined development command is also available:

```bash
composer dev
```

This starts the Laravel server, queue listener, log viewer, and Vite dev server simultaneously.

---

## 8. Security

- **CSRF Protection** — All forms include CSRF tokens to prevent cross-site request forgery.
- **Input Validation** — Server-side validation on all user-submitted data.
- **SQL Injection Prevention** — Laravel's Eloquent ORM uses parameterized queries by default.
- **Environment Configuration** — Sensitive data (database credentials, API keys) stored in `.env` file, excluded from version control.
- **Session Security** — Sessions stored in the database with configurable encryption.

---

## 9. Future Enhancements

Potential features for future phases:

- **Online Admission Application** — A multi-step form for direct online enrollment.
- **Parent Portal** — Secure login for parents to track student progress.
- **News & Events** — A blog or announcement system for school news.
- **Online Payment Integration** — Fee payment through Paystack or Flutterwave.
- **Email Notifications** — Automatic email alerts to administrators when a new contact form is submitted.
- **Admin Authentication** — Password-protected admin dashboard with role-based access.
- **Multi-Language Support** — Full Arabic language version of the website.
- **SEO Optimization** — Structured data, sitemap, and meta tag management.

---

## 10. Contact Information

| | |
|---|---|
| **School** | Abu Haneefah Islamic Academy |
| **Address** | Wisdom Street, along Agbara Lusada Road, Onigbongbo Atan, Ogun State, Nigeria |
| **Email** | abuaneefah330@gmail.com |
| **Phone** | +234 805 650 1115 |
| **Social Media** | Facebook, Instagram (@ibnalaroby), WhatsApp |

---

*This documentation provides an overview of the Abu Haneefah Islamic Academy website as delivered. For technical questions or support, please contact the development team.*
