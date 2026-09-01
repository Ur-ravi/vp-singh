# V P Singh Advocate — Complete Website

A production-ready, CMS-driven legal services website built with CodeIgniter 4, PHP 8.2+, and MySQL.

## Technology Stack

- **Backend:** CodeIgniter 4.7.4, PHP 8.2+, MySQL/MariaDB
- **Frontend:** HTML5, CSS3, Tailwind CSS, Vanilla JavaScript, Alpine.js
- **Admin:** Custom CodeIgniter 4 admin panel with role-based authentication

## Features

- 19+ database-driven pages
- Full CMS admin panel
- Blog with categories and tags
- Consultation booking system with payment workflow
- QR code and bank transfer payment methods
- Media library
- SEO system with XML sitemap
- Responsive design with mobile sticky CTA
- Role-based admin authentication (Super Admin / Editor)

## Setup Instructions

### Prerequisites

- PHP 8.2+
- MySQL 8+ / MariaDB 10.4+
- XAMPP, WAMP, or similar PHP/MySQL environment

### Installation

1. Clone or copy this project to your web server directory
2. Create a MySQL database:
   ```sql
   CREATE DATABASE vp_singh_advocate CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```
3. Configure the `.env` file with your database credentials
4. Run migrations:
   ```bash
   php spark migrate
   ```
5. Seed the database with default content:
   ```bash
   php spark db:seed DatabaseSeeder
   ```

### Access

- **Website:** `http://localhost/vp-singh-advocate/public/`
- **Admin Panel:** `http://localhost/vp-singh-advocate/public/admin/login`

### Default Admin Credentials

| Email | Password | Role |
|-------|----------|------|
| admin@vpsinghadvocate.com | Admin@123 | Super Admin |
| editor@vpsinghadvocate.com | Editor@123 | Editor |

## Project Structure

```
app/
├── Config/          # Routes, App config, Filters
├── Controllers/     # Frontend + Admin controllers
│   ├── Admin/       # Admin CRUD controllers
│   ├── Home.php     # Homepage
│   ├── Blog.php     # Blog
│   ├── Consultation.php
│   ├── Contact.php
│   ├── PracticeAreas.php
│   └── ...
├── Database/
│   ├── Migrations/  # 21 database migrations
│   └── Seeds/       # Default data seeders
├── Entities/
├── Filters/         # AdminAuth, CSRF
├── Helpers/
├── Libraries/       # Settings, Auth
├── Models/          # 15 Eloquent-style models
├── Services/
└── Views/
    ├── admin/       # Admin panel views
    └── frontend/    # Public website views
public/
├── assets/          # CSS, JS, images
├── uploads/         # User-uploaded media
└── .htaccess        # Clean URL rewriting
```

## Database Tables

- `users` — Admin users with roles
- `site_settings` — Global site settings
- `pages` — Static pages
- `page_sections` — Dynamic page sections
- `practice_areas` — Legal practice areas
- `advocate_profile` — Advocate information
- `locations` — Office locations
- `blog_posts`, `blog_categories`, `blog_tags`, `blog_post_tags` — Blog system
- `faqs` — Frequently asked questions
- `testimonials` — Client testimonials
- `consultations` — Consultation bookings
- `payments` — Payment records
- `payment_methods` — QR and bank details
- `enquiries` — Contact form submissions
- `media` — Media library
- `announcements` — Announcement bar
- `menus`, `menu_items` — Navigation management
- `seo_metadata` — SEO data

## Admin Panel Capabilities

Every business element can be managed from the admin panel:

- ✅ Site settings (name, phone, email, logo, etc.)
- ✅ Homepage sections (hero, trust, intro, why choose, how it works)
- ✅ Navigation menus
- ✅ Advocate profile (name, bio, photo, credentials)
- ✅ Practice areas (create, edit, reorder, publish)
- ✅ Blog (posts, categories, tags)
- ✅ FAQs (assignable to any page)
- ✅ Testimonials
- ✅ Locations
- ✅ Consultations (booking management)
- ✅ Payments (QR code, bank details, transaction management)
- ✅ Enquiries (contact form submissions)
- ✅ Media library
- ✅ Announcements
- ✅ SEO metadata per page
- ✅ Users (Super Admin manages users)

## Deployment

This application can be deployed on any standard PHP/MySQL hosting:

1. Upload all files to your hosting account
2. Create the database and import or run migrations
3. Update `.env` with production settings
4. Set `CI_ENVIRONMENT = production` in `.env`
5. Set proper file permissions on `writable/` directory

## License

This is a custom project for V P Singh Advocate.
