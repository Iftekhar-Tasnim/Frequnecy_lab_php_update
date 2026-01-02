@echo off
echo Packaging Frequency Lab for Deployment...

:: Create a temporary folder
if exist "deploy_temp" rmdir /s /q "deploy_temp"
mkdir "deploy_temp"

:: Copy files
echo Copying files...
xcopy "admin" "deploy_temp\admin" /s /e /i /y

xcopy "api" "deploy_temp\api" /s /e /i /y

xcopy "assets" "deploy_temp\assets" /s /e /i /y
xcopy "css" "deploy_temp\css" /s /e /i /y
xcopy "includes" "deploy_temp\includes" /s /e /i /y
xcopy "js" "deploy_temp\js" /s /e /i /y
xcopy "pages" "deploy_temp\pages" /s /e /i /y
xcopy "database" "deploy_temp\database" /s /e /i /y

copy "index.php" "deploy_temp\"
copy "migrate.php" "deploy_temp\"
copy "process_contact.php" "deploy_temp\"
copy "README.md" "deploy_temp\"

:: Create Zip (Using PowerShell)
echo Zipping files...
powershell -command "Compress-Archive -Path 'deploy_temp\*' -DestinationPath 'Frequency_Lab_Deploy.zip' -Force"

:: Cleanup
rmdir /s /q "deploy_temp"

echo Done! Deployment package created: Frequency_Lab_Deploy.zip
echo Unzip this file on your hosting server (public_html).
timeout /t 5
