@echo off
setlocal enabledelayedexpansion

echo ========================================
echo Frequency Lab - Deployment Package Tool
echo ========================================
echo.

:: Configuration
set PACKAGE_NAME=Frequency_Lab_Deploy
set TEMP_DIR=deploy_temp
set OUTPUT_ZIP=%PACKAGE_NAME%.zip

:: Step 1: Build CSS from Tailwind
echo [1/5] Building production CSS...
call npm run build
if errorlevel 1 (
    echo ERROR: CSS build failed!
    pause
    exit /b 1
)
echo CSS build completed successfully.
echo.

:: Step 2: Clean up old deployment files
echo [2/5] Cleaning up old deployment files...
if exist "%TEMP_DIR%" rmdir /s /q "%TEMP_DIR%"
if exist "%OUTPUT_ZIP%" del /f /q "%OUTPUT_ZIP%"
echo Cleanup completed.
echo.

:: Step 3: Create deployment directory structure
echo [3/5] Creating deployment package structure...
mkdir "%TEMP_DIR%"

:: Copy directories
echo Copying directories...
xcopy "admin" "%TEMP_DIR%\admin\" /s /e /i /y /q
xcopy "api" "%TEMP_DIR%\api\" /s /e /i /y /q
xcopy "assets" "%TEMP_DIR%\assets\" /s /e /i /y /q
xcopy "css" "%TEMP_DIR%\css\" /s /e /i /y /q
xcopy "database\migrations" "%TEMP_DIR%\database\migrations\" /s /e /i /y /q
xcopy "includes" "%TEMP_DIR%\includes\" /s /e /i /y /q
xcopy "js" "%TEMP_DIR%\js\" /s /e /i /y /q
xcopy "pages" "%TEMP_DIR%\pages\" /s /e /i /y /q

:: Copy root files
echo Copying root files...
copy "index.php" "%TEMP_DIR%\" >nul
copy "migrate.php" "%TEMP_DIR%\" >nul
copy "process_contact.php" "%TEMP_DIR%\" >nul
copy "README.md" "%TEMP_DIR%\" >nul

:: Copy .htaccess if exists
if exist ".htaccess" (
    copy ".htaccess" "%TEMP_DIR%\" >nul
    echo .htaccess copied.
)

:: Create config directory and copy template
echo Creating config template...
mkdir "%TEMP_DIR%\config"
copy "config\db.example.php" "%TEMP_DIR%\config\db.example.php" >nul

:: Create cache directory structure
echo Creating cache directory...
mkdir "%TEMP_DIR%\cache"
copy "cache\.htaccess" "%TEMP_DIR%\cache\.htaccess" >nul
copy "cache\index.php" "%TEMP_DIR%\cache\index.php" >nul
echo.

:: Step 4: Create deployment instructions
echo [4/5] Creating deployment instructions...
(
echo ========================================
echo Frequency Lab - Deployment Instructions
echo ========================================
echo.
echo 1. UPLOAD FILES
echo    - Upload all files to your web server's public_html or www directory
echo.
echo 2. CONFIGURE DATABASE
echo    - Navigate to the 'config' folder
echo    - Copy 'db.example.php' to 'db.php'
echo    - Edit 'db.php' with your database credentials:
echo      * $host = 'localhost' ^(or your DB host^)
echo      * $db   = 'your_database_name'
echo      * $user = 'your_database_user'
echo      * $pass = 'your_database_password'
echo.
echo 3. RUN MIGRATIONS
echo    - Navigate to: https://yourdomain.com/migrate.php
echo    - This will create all necessary database tables
echo    - For security, delete migrate.php after running it
echo.
echo 4. VERIFY INSTALLATION
echo    - Visit your website homepage
echo    - Test the contact form
echo    - Login to admin panel at: https://yourdomain.com/admin/
echo.
echo 5. SECURITY CHECKLIST
echo    - Ensure config/db.php is NOT publicly accessible
echo    - Delete migrate.php after running migrations
echo    - Change default admin password immediately
echo    - Set proper file permissions ^(644 for files, 755 for directories^)
echo.
echo 6. TROUBLESHOOTING
echo    - If you see database errors, verify db.php credentials
echo    - If CSS is not loading, check file paths in your hosting
echo    - Enable error reporting temporarily if needed
echo.
echo For support, refer to README.md
echo ========================================
) > "%TEMP_DIR%\DEPLOYMENT_GUIDE.txt"
echo Deployment guide created.
echo.

:: Step 5: Create ZIP package
echo [5/5] Creating ZIP package...
powershell -command "Compress-Archive -Path '%TEMP_DIR%\*' -DestinationPath '%OUTPUT_ZIP%' -Force"
if errorlevel 1 (
    echo ERROR: Failed to create ZIP package!
    pause
    exit /b 1
)
echo.

:: Cleanup temporary directory
echo Cleaning up temporary files...
rmdir /s /q "%TEMP_DIR%"

:: Success message
echo ========================================
echo SUCCESS! Deployment package created.
echo ========================================
echo.
echo Package: %OUTPUT_ZIP%
echo.
echo NEXT STEPS:
echo 1. Upload and extract %OUTPUT_ZIP% on your hosting server
echo 2. Follow instructions in DEPLOYMENT_GUIDE.txt
echo 3. Configure database credentials in config/db.php
echo 4. Run migrate.php to set up the database
echo.
echo ========================================

timeout /t 10
