# Frequency Lab (F_Lab)

**Frequency Lab** is a Bangladesh-based EdTech social enterprise dedicated to nurturing a new generation of technology innovators through hands-on STEM education in Coding, Electronics, and Robotics.

This repository contains the source code for the public-facing website and the custom-built **Admin Dashboard (CMS)** used to manage the site's content.

## 🚀 Key Features

### 🌐 Public Website
-   **Modern Design**: Built with a "Cyber/Tech" aesthetic using Tailwind CSS and custom animations.
-   **Responsive**: Fully optimized for mobile, tablet, and desktop devices.
-   **Dynamic Pages**:
    -   **Home**: Hero section, stats, and program highlights.
    -   **About**: Mission, vision, and team showcase.
    -   **Contact**: Functional contact form with email integration.

### 🔐 Admin Dashboard
A secure, custom-built CMS to manage website data without coding.
-   **Dashboard**: Real-time stats overview.
-   **Team Management**: Add, edit, delete, and reorder team members (Board, Executives, Advisors).
-   **Contact Messages**: View and manage inquiries received from the website.
-   **User Management**: Role-based access control (RBAC) for Admins and Staff.
-   **Security**:
    -   Secure Login with Password Hashing.
    -   Session Security (Fixation protection, Timeout).
    -   Role protection (Staff cannot delete content or access user management).
    -   403 Access Denied handling.

---

## 🛠️ Technology Stack

-   **Backend**: PHP 8.x (Vanilla, no framework)
-   **Database**: MySQL (via PDO for security)
-   **Frontend**: HTML5, Vanilla JavaScript
-   **Styling**: [Tailwind CSS 3.x](https://tailwindcss.com/)
-   **Typography**: Inter (Body), Exo 2 (Headings)

---

## 📂 Project Structure

```text
F_lab/
├── admin/              # Secure Admin Panel source code
│   ├── includes/       # Admin components (Sidebar, Auth, Header)
│   ├── js/             # Admin-specific scripts
│   ├── 403.php         # Access Denied page
│   ├── dashboard.php   # Admin Home
│   └── ...             # Management pages (users, team, messages)
├── assets/             # Images, Logos, and Uploads
├── config/             # Database configuration (db.php)
├── css/                # Compiled production CSS (style.css)
├── includes/           # Public site shared components (Navbar, Footer, Auth)
├── pages/              # Public website pages
├── sql/                # Database schema and migration scripts
├── src/                # Tailwind source files
│   └── input.css      # Core Tailwind CSS entry point
├── index.php           # Main entry point
├── package.json        # NPM dependencies for Tailwind
└── tailwind.config.js  # Tailwind configuration
```

---

## 💻 Installation & Setup

### 1. Prerequisites
-   **XAMPP** (or any PHP/MySQL environment)
-   **Node.js** (for Tailwind CSS development)

### 2. Database Setup
1.  Open phpMyAdmin.
2.  Create a database named `f_lab_db` (or match `config/db.php`).
3.  Import `sql/schema.sql` to set up tables.
4.  (Optional) Import `sql/contact_messages_migration.sql` if updating from an older version.

### 3. Project Configuration
1.  Clone/Copy the project to your `htdocs` folder: `C:\xampp\htdocs\F_lab`.
2.  Configure database credentials in `config/db.php` if needed.

### 4. Build Styles (Tailwind CSS)
The project uses Tailwind CSS. You must build the CSS file for styles to appear correct.

```bash
# Install dependencies
npm install

# Build CSS for Production (Minified)
npm run build

# OR: Watch for changes during development
npm run dev
```

### 5. Access the Application
-   **Website**: [http://localhost/F_lab/](http://localhost/F_lab/)
-   **Admin Panel**: [http://localhost/F_lab/admin/](http://localhost/F_lab/admin/)

---

## 🔒 Access Control (RBAC)

| Role | Permissions |
| :--- | :--- |
| **Admin** | Full access. Can create/delete users, delete content, and manage all settings. |
| **Staff** | Restricted access. Can view/add/edit content (Team, Messages) but **cannot delete** items or manage users. |

---

## 📄 License
© 2025 Frequency Lab. All rights reserved.
