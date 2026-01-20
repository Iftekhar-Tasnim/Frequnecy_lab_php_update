# Frequency Lab - PowerShell Deployment Script
# This script creates an optimized deployment package

param(
    [switch]$SkipBuild = $false
)

$ErrorActionPreference = "Stop"

# Configuration
$PackageName = "Frequency_Lab_Deploy"
$TempDir = "deploy_temp"
$OutputZip = "$PackageName.zip"

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Frequency Lab - Deployment Package Tool" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

try {
    # Step 1: Build CSS
    if (-not $SkipBuild) {
        Write-Host "[1/5] Building production CSS..." -ForegroundColor Yellow
        $buildProcess = Start-Process -FilePath "npm" -ArgumentList "run", "build" -Wait -PassThru -NoNewWindow
        if ($buildProcess.ExitCode -ne 0) {
            throw "CSS build failed!"
        }
        Write-Host "CSS build completed successfully." -ForegroundColor Green
        Write-Host ""
    } else {
        Write-Host "[1/5] Skipping CSS build (using existing)..." -ForegroundColor Yellow
        Write-Host ""
    }

    # Step 2: Cleanup
    Write-Host "[2/5] Cleaning up old deployment files..." -ForegroundColor Yellow
    if (Test-Path $TempDir) {
        Remove-Item -Path $TempDir -Recurse -Force
    }
    if (Test-Path $OutputZip) {
        Remove-Item -Path $OutputZip -Force
    }
    Write-Host "Cleanup completed." -ForegroundColor Green
    Write-Host ""

    # Step 3: Create structure
    Write-Host "[3/5] Creating deployment package structure..." -ForegroundColor Yellow
    New-Item -ItemType Directory -Path $TempDir -Force | Out-Null

    # Define what to copy
    $directoriesToCopy = @(
        @{Source="admin"; Dest="admin"},
        @{Source="api"; Dest="api"},
        @{Source="assets"; Dest="assets"},
        @{Source="css"; Dest="css"},
        @{Source="database\migrations"; Dest="database\migrations"},
        @{Source="includes"; Dest="includes"},
        @{Source="js"; Dest="js"},
        @{Source="pages"; Dest="pages"}
    )

    $filesToCopy = @(
        "index.php",
        "migrate.php",
        "process_contact.php",
        "README.md"
    )

    # Copy directories
    Write-Host "Copying directories..." -ForegroundColor Gray
    foreach ($dir in $directoriesToCopy) {
        if (Test-Path $dir.Source) {
            $destPath = Join-Path $TempDir $dir.Dest
            Copy-Item -Path $dir.Source -Destination $destPath -Recurse -Force
            Write-Host "  ✓ $($dir.Source)" -ForegroundColor DarkGray
        }
    }

    # Copy files
    Write-Host "Copying root files..." -ForegroundColor Gray
    foreach ($file in $filesToCopy) {
        if (Test-Path $file) {
            Copy-Item -Path $file -Destination $TempDir -Force
            Write-Host "  ✓ $file" -ForegroundColor DarkGray
        }
    }

    # Copy .htaccess if exists
    if (Test-Path ".htaccess") {
        Copy-Item -Path ".htaccess" -Destination $TempDir -Force
        Write-Host "  ✓ .htaccess" -ForegroundColor DarkGray
    }

    # Create config directory and copy template
    Write-Host "Creating config template..." -ForegroundColor Gray
    New-Item -ItemType Directory -Path "$TempDir\config" -Force | Out-Null
    Copy-Item -Path "config\db.example.php" -Destination "$TempDir\config\db.example.php" -Force
    Write-Host "  ✓ config/db.example.php" -ForegroundColor DarkGray
    Write-Host ""

    # Step 4: Create deployment guide
    Write-Host "[4/5] Creating deployment instructions..." -ForegroundColor Yellow
    
    $deploymentGuide = @"
========================================
Frequency Lab - Deployment Instructions
========================================

1. UPLOAD FILES
   - Upload all files to your web server's public_html or www directory

2. CONFIGURE DATABASE
   - Navigate to the 'config' folder
   - Copy 'db.example.php' to 'db.php'
   - Edit 'db.php' with your database credentials:
     * `$host = 'localhost' (or your DB host)
     * `$db   = 'your_database_name'
     * `$user = 'your_database_user'
     * `$pass = 'your_database_password'

3. RUN MIGRATIONS
   - Navigate to: https://yourdomain.com/migrate.php
   - This will create all necessary database tables
   - For security, delete migrate.php after running it

4. VERIFY INSTALLATION
   - Visit your website homepage
   - Test the contact form
   - Login to admin panel at: https://yourdomain.com/admin/

5. SECURITY CHECKLIST
   - Ensure config/db.php is NOT publicly accessible
   - Delete migrate.php after running migrations
   - Change default admin password immediately
   - Set proper file permissions (644 for files, 755 for directories)

6. TROUBLESHOOTING
   - If you see database errors, verify db.php credentials
   - If CSS is not loading, check file paths in your hosting
   - Enable error reporting temporarily if needed

For support, refer to README.md
========================================
"@

    $deploymentGuide | Out-File -FilePath "$TempDir\DEPLOYMENT_GUIDE.txt" -Encoding UTF8
    Write-Host "Deployment guide created." -ForegroundColor Green
    Write-Host ""

    # Step 5: Create ZIP
    Write-Host "[5/5] Creating ZIP package..." -ForegroundColor Yellow
    Compress-Archive -Path "$TempDir\*" -DestinationPath $OutputZip -Force
    Write-Host ""

    # Cleanup
    Write-Host "Cleaning up temporary files..." -ForegroundColor Gray
    Remove-Item -Path $TempDir -Recurse -Force

    # Success
    Write-Host "========================================" -ForegroundColor Green
    Write-Host "SUCCESS! Deployment package created." -ForegroundColor Green
    Write-Host "========================================" -ForegroundColor Green
    Write-Host ""
    Write-Host "Package: $OutputZip" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "NEXT STEPS:" -ForegroundColor Yellow
    Write-Host "1. Upload and extract $OutputZip on your hosting server"
    Write-Host "2. Follow instructions in DEPLOYMENT_GUIDE.txt"
    Write-Host "3. Configure database credentials in config/db.php"
    Write-Host "4. Run migrate.php to set up the database"
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Green

} catch {
    Write-Host ""
    Write-Host "ERROR: $_" -ForegroundColor Red
    Write-Host ""
    exit 1
}
