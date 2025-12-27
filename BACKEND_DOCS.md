# Backend Architecture & Access Control Documentation

## Project Overview
**Frequency Lab Admin** is a secure, role-based Content Management System (CMS) built with **Vanilla PHP** and **Tailwind CSS**. It manages Users, Team Members, and future modules.

---

## 1. Technology Stack
-   **Backend**: PHP 8 (Vanilla, no framework).
-   **Database**: MySQL (via PDO for security).
-   **Frontend**: Tailwind CSS (CDN/Local), Vanilla JavaScript.
-   **Server**: XAMPP (Apache/MySQL).

---

## 2. Database Schema
### `users` Table
Stores administrator and staff credentials.
-   `id` (INT, PK, Auto Increment)
-   `username` (VARCHAR, Unique)
-   `email` (VARCHAR, Unique) **[New]**
-   `password_hash` (VARCHAR)
-   `role` (ENUM: 'admin', 'staff')
-   `created_at` (TIMESTAMP)

### `team_members` Table
Stores team member profiles for the frontend website.
-   `id` (INT, PK)
-   `name`, `designation`, `category` (board/advisor/executive)
-   `image_path`, `bio`, `display_order`
-   `created_at`, `updated_at`

---

## 3. Role-Based Access Control (RBAC)
The system distinguishes between **Admin** and **Staff** roles.

### **Administrator (`admin`)**
-   **Full Access**: Can View, Create, Edit, and **Delete** all content.
-   **User Management**: Exclusive access to `users.php` to Add/Edit/Delete other users.
-   **Role Management**: Can promote/demote users.
-   **UI Visibility**: Sees "Delete" buttons and "Add New User" shortcuts.

### **Staff (`staff`)**
-   **Content Management**: Can **View**, **Add**, and **Edit** content (e.g., Team Members).
-   **Restricted Actions**:
    -   **CANNOT Delete** any content (Buttons hidden, Backend protected).
    -   **CANNOT Access** User Management (Redirected if attempted).
    -   **CANNOT Change** other users' passwords or roles.

---

## 4. Key Security Features
1.  **Authentication Middleware**:
    -   `includes/auth.php`: `checkRole('admin')` ensures strict access control.
2.  **Password Verification**:
    -   Profile updates (Username/Email) require **Current Password verification**.
3.  **SQL Injection Protection**:
    -   All database queries use **PDO Prepared Statements**.
4.  **XSS Protection**:
    -   Output is sanitized using `htmlspecialchars()`.

---

## 5. File Structure
-   `admin/`
    -   `dashboard.php`: Main overview.
    -   `users.php` / `user_form.php`: User management (Admin only).
    -   `team_members.php` / `team_form.php`: Team content management.
    -   `profile.php`: Self-profile management (Username/Email/Password).
    -   `login.php`: Authentication entry point.
-   `includes/`
    -   `auth.php`: Auth class & session logic.
    -   `sidebar.php`: Navigation component (Role-aware).
-   `config/`
    -   `db.php`: Database connection settings.

---
*Generated: 2025-12-27*
