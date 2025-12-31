# Frequency Lab (F_Lab)

**Frequency Lab** is a Bangladesh-based EdTech social enterprise dedicated to nurturing a new generation of technology innovators through hands-on STEM education in Coding, Electronics, and Robotics.

This repository contains the source code for the public-facing website and the custom-built **Admin Dashboard (CMS)** used to manage the site's content.

## 🚀 Key Features

### 🌐 Public Website
-   **Premium Cyber Aesthetic**: A visually striking dark-themed UI featuring "Prussian Blue" tones, glassmorphism, and ambient blob animations.
-   **Responsive & Dynamic**: Fully optimized for all devices with smooth transitions and interactions.
-   **Core Pages**:
    -   **Home**: Immersive hero section, impact stats, and program highlights.
    -   **About**: Mission, vision, and team showcase with high-contrast profiles.
    -   **Gallery**: Interactive lightbox gallery with filterable categories.
    -   **Publications**: Research and news updates.
    -   **Contact**: Secure contact form integrated directly with the backend database.

### 🔐 Admin Dashboard
A powerful, secure CMS featuring the "Premium Cyber" dark theme to match the public site.
-   **Dashboard**: Real-time analytical overview with glassmorphism cards.
-   **Gallery Management**: Drag-and-drop image uploads, category sorting, and bulk management.
-   **Team Management**: Reorderable list of team members (Board, Executives, Advisors) with drag-and-drop functionality.
-   **Publications**: Manage research papers, articles, and news releases.
-   **Programmes**: Create and update course offerings and workshop details.
-   **Contact Messages**: centralized inbox to view and manage inquiries (Database storage only, no SMTP dependency).
-   **Settings**: Customize application preferences and access controls.

### 🛡️ Security & Access Control
-   **Role-Based Access Control (RBAC)**: Distinct permissions for **Admin** (Full Access) and **Staff** (Restricted Access).
-   **Secure Authentication**: Password hashing, session fixation protection, and timeout logic.
-   **Input Sanitization**: comprehensive filtering to prevent XSS and SQL injection.

---

## 🛠️ Technology Stack

-   **Backend**: PHP 8.x (Vanilla, no framework)
-   **Database**: MySQL (via PDO for robust security)
-   **Frontend**: HTML5, Vanilla JavaScript, Alpine.js (for some interactive components)
-   **Styling**: [Tailwind CSS 3.x](https://tailwindcss.com/) (Custom configuration with 'Prussian Blue' palette and 'Exo 2' typography)
-   **Build Tool**: Node.js & NPM (for Tailwind compilation)

---

## 📂 Project Structure

```text
F_lab/
├── admin/              # Secure Admin Panel source code
│   ├── includes/       # Shared admin components (Sidebar, Auth, Header)
│   ├── assets/         # Admin-specific assets
│   ├── dashboard.php   # Admin Overview
│   ├── gallery.php     # Gallery Management
│   ├── team_members.php # Team Management
│   └── ...             # Other management modules
├── assets/             # Public site images, logos, and uploads
├── config/             # Database connection (db.php)
├── css/                # Compiled production CSS (style.css)
├── includes/           # Public site shared components (Navbar, Footer)
├── pages/              # Public facing pages (Contact, About, Gallery, etc.)
├── sql/                # Database schema and migration scripts
├── src/                # Tailwind source files
│   └── input.css      # Core Tailwind CSS entry point
├── index.php           # Landing Page
├── package.json        # NPM dependencies
└── tailwind.config.js  # Tailwind configuration and theme customization
```

---

## 💻 Installation & Setup

### 1. Prerequisites
-   **XAMPP** (or any LAMP/WAMP stack)
-   **Node.js** (LTS version recommended)

### 2. Database Setup
1.  Open phpMyAdmin.
2.  Create a database named `f_lab_db`.
3.  Import `sql/schema.sql` to initialize the tables.
4.  Run any additional migration scripts from the `sql/` folder if upgrading.

### 3. Project Configuration
1.  Clone or place the project in your server's root (e.g., `C:\xampp\htdocs\F_lab`).
2.  Verify credentials in `config/db.php`:
    ```php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'f_lab_db');
    ```

### 4. Build Styles
The project relies on Tailwind CSS. You must compile the styles before viewing the site.

```bash
# Install dependencies
npm install

# Build CSS for Production (Minified)
npm run build

# OR: Watch for changes during development
npm run dev
```

### 5. Access the Application
-   **Public Site**: [http://localhost/F_lab/](http://localhost/F_lab/)
-   **Admin Panel**: [http://localhost/F_lab/admin/](http://localhost/F_lab/admin/)

---

## 🔒 User Roles

| Role | Permissions |
| :--- | :--- |
| **Admin** | **Full Control**. Can create/delete users, permanently delete content, and modify system settings. |
| **Staff** | **Operational Access**. Can view, add, and edit content (Team, Messages, Gallery) but **cannot delete** items or access user management. |

---

## 📄 License
© 2025 Frequency Lab. All rights reserved.
