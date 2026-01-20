# Frequency Lab - Deployment Guide

## 📦 Quick Start

### For Windows Users

**Option 1: Using Batch Script (Recommended)**
```bash
deploy.bat
```

**Option 2: Using PowerShell**
```powershell
.\deploy.ps1
```

To skip CSS rebuild (faster):
```powershell
.\deploy.ps1 -SkipBuild
```

---

## 🎯 What the Deployment Script Does

The deployment script automatically:

1. ✅ **Builds production CSS** from Tailwind source
2. ✅ **Excludes development files** (node_modules, src, tests, etc.)
3. ✅ **Excludes sensitive files** (config/db.php, .env)
4. ✅ **Creates database config template** for production
5. ✅ **Packages only necessary files** for production
6. ✅ **Generates deployment instructions** (DEPLOYMENT_GUIDE.txt)
7. ✅ **Creates optimized ZIP file** ready for upload

---

## 📋 Files Included in Deployment Package

### ✅ Included
- `admin/` - Admin panel
- `api/` - API endpoints
- `assets/` - Images, uploads, etc.
- `css/` - **Production-built CSS** (minified)
- `database/migrations/` - Database migration files
- `includes/` - PHP includes
- `js/` - JavaScript files
- `pages/` - Page templates
- `index.php` - Main entry point
- `migrate.php` - Database migration runner
- `process_contact.php` - Contact form handler
- `README.md` - Project documentation
- `.htaccess` - Server configuration (if exists)
- `config/db.example.php` - Database config template

### ❌ Excluded (Development Only)
- `node_modules/` - NPM dependencies
- `src/` - Tailwind source files
- `.git/` - Git repository
- `package.json`, `package-lock.json` - NPM config
- `tailwind.config.js` - Tailwind config
- `config/db.php` - Local database credentials
- `tests/`, `playwright.config.js` - Test files
- `*.zip`, `deploy_temp/` - Build artifacts
- `.env` - Environment variables

---

## 🚀 Deployment Steps

### Step 1: Create Deployment Package
```bash
deploy.bat
```
This creates `Frequency_Lab_Deploy.zip`

### Step 2: Upload to Server
1. Connect to your hosting via FTP/SFTP or cPanel File Manager
2. Navigate to `public_html` or `www` directory
3. Upload `Frequency_Lab_Deploy.zip`
4. Extract the ZIP file
5. Delete the ZIP file after extraction

### Step 3: Configure Database
1. Navigate to the `config/` folder
2. Copy `db.example.php` to `db.php`
3. Edit `db.php` with your actual database credentials:
   ```php
   $host = 'localhost';           // Your DB host
   $db   = 'your_database_name';  // Your DB name
   $user = 'your_database_user';  // Your DB username
   $pass = 'your_database_pass';  // Your DB password
   ```

### Step 4: Run Database Migrations
1. Visit: `https://yourdomain.com/migrate.php`
2. Wait for migrations to complete
3. **Delete `migrate.php` for security** after successful migration

### Step 5: Verify Installation
- ✅ Visit homepage: `https://yourdomain.com`
- ✅ Test contact form
- ✅ Login to admin: `https://yourdomain.com/admin/`
- ✅ Check all pages load correctly

---

## 🔒 Security Checklist

After deployment, ensure:

- [ ] `config/db.php` is NOT publicly accessible
- [ ] `migrate.php` is deleted after running
- [ ] Default admin password is changed
- [ ] File permissions are set correctly:
  - Files: `644`
  - Directories: `755`
  - `config/db.php`: `600` (if possible)
- [ ] `.htaccess` is properly configured
- [ ] Error reporting is disabled in production
- [ ] HTTPS is enabled (SSL certificate)

---

## 🛠️ Troubleshooting

### CSS Not Loading
- Verify `css/style.css` exists and is not empty
- Check browser console for 404 errors
- Ensure file paths are correct in hosting environment

### Database Connection Errors
- Verify `config/db.php` credentials are correct
- Ensure database exists on server
- Check database user has proper permissions
- Confirm database host is correct (might not be 'localhost')

### 500 Internal Server Error
- Check PHP version (requires PHP 7.4+)
- Review server error logs
- Verify file permissions
- Ensure `.htaccess` is compatible with server

### Contact Form Not Working
- Check `process_contact.php` is accessible
- Verify database connection
- Check email configuration in hosting
- Review browser console for JavaScript errors

### Admin Panel Access Issues
- Verify admin user exists in database
- Check session configuration in hosting
- Ensure cookies are enabled
- Try clearing browser cache

---

## 📁 Deployment Configuration

The deployment process is controlled by `deploy.config.json`. You can customize:

- Package name
- Files/folders to include
- Files/folders to exclude
- Whether to build CSS
- Config template mappings

---

## 🔄 Re-deployment

For updates after initial deployment:

1. Make changes locally
2. Test thoroughly on localhost
3. Run `deploy.bat` to create new package
4. Upload and extract on server
5. **Do NOT overwrite `config/db.php`** (keep your production credentials)
6. Run `migrate.php` if database changes exist
7. Clear browser cache and test

---

## 📞 Support

For issues or questions:
1. Check `DEPLOYMENT_GUIDE.txt` in the deployment package
2. Review server error logs
3. Refer to main `README.md` for project documentation
4. Contact hosting support for server-specific issues

---

## 📝 Notes

- **Always backup** your production database before re-deploying
- **Test locally first** before deploying to production
- **Keep `config/db.php` secure** - never commit to version control
- **Use HTTPS** in production for security
- **Monitor error logs** regularly
